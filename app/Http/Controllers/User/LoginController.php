<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Service\User\IService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    private $userService;

    public function __construct(IService $userService)
    {
        $this->middleware('guest')->except('user.logout');
        $this->userService = $userService;
    }

    /**
     * ログイン画面表示
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showLoginForm(): mixed
    {
        return view('user.login');
    }

    /**
     * ログイン処理
     *
     * @param \Illuminate\Http\Request $request リクエスト
     *
     * @return mixed
     */
    public function processLogin(Request $request): mixed
    {
        try {
            $request->validate(
                [
                    'login' => 'required',
                    // TODO password length
                    'password' => 'required'
                ]
            );

            $login = $request->only('login')['login'];
            $password = $request->only('password')['password'];

            // 有効なusernameだったら、usernameログイン情報を設定
            $user = $this->userService->searchUserByUsername($login);
            if (!empty($user)) {
                // TODO login with username
                $credentials = [
                    'username' => $login,
                    'password' => $password
                ];
            }

            // 有効なemailだったら、emailログイン情報を設定
            $user = $this->userService->searchUserByEmail($login);
            if (!empty($user)) {
                // TODO login with email
                $credentials = [
                    'email' => $login,
                    'password' => $password
                ];
            }

            if (Auth::attempt($credentials)) {
                return \redirect()->route('/');
            }

            session()->flash('message', 'invalid credentials');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('message', 'invalid credentials');
            return redirect()->back();
        }
    }

    /**
     * ユーザ登録画面表示
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showSignupForm(): mixed
    {
        return view('user.signup');
    }

    /**
     * ユーザ登録処理
     *
     * @param \Illuminate\Http\Request $request リクエスト
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processSignup(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'username' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]
        );

        $isCreated = $this->userService->createUser(
            $request->input('firstName'),
            $request->input('LastName'),
            $request->input('username'),
            $request->input('email'),
            $request->input('password')
        );

        if ($isCreated) {
            session()->flash('message', 'Your account was created successfully.');
            return redirect()->route('user.login');
        }

        session()->flash('message', "There was an error. Your account couldn't be created.");
        return redirect()->route('user.signup');
    }

    /**
     * ログアウト処理
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        \Auth::logout();
        return redirect()->route('user.login');
    }
}
