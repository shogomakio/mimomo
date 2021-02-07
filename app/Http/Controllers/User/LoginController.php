<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Service\User\IService;
use App\Validation\User\LoginValidation;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use LoginValidation;

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
            $this->validateLoginData($request->all());

            $login = $request->only('login')['login'];
            $password = $request->only('password')['password'];

            // usernameでログイン
            $user = $this->userService->searchUserByUsername($login);
            if (is_null($user) === false && \boolval($user->email_verified)) {
                // 有効なusernameだったら、ログイン実行
                $credentials = [
                    'username' => $login,
                    'password' => $password
                ];

                if (Auth::attempt($credentials)) {
                    return \redirect()->route('/');
                }
            }

            // emailでログイン
            $user = $this->userService->searchUserByEmail($login);
            if (is_null($user) === false && \boolval($user->email_verified)) {
                // 有効なemailだったら、ログイン実行
                $credentials = [
                    'email' => $login,
                    'password' => $password
                ];

                if (Auth::attempt($credentials)) {
                    return \redirect()->route('/');
                }
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
