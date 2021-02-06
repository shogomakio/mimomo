<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('guest')->except('logout');
        $this->userService = $userService;
    }

    /**
     * ログイン画面表示
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show_login_form(): mixed
    {
        return view('user.login');
    }

    /**
     * ログイン処理
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function process_login(Request $request): mixed
    {
        $request->validate([
            'login' => 'required',
            // TODO password length
            'password' => 'required'
        ]);

        $login = $request->only('login')['login'];
        $password = $request->only('password')['password'];

        if (empty($login)) {
            session()->flash('message', 'invalid credentials');
            return redirect()->back();
        }

        $user = $this->userService->searchUserByUsername($login);

        if (!empty($user)) {
            // TODO login with username
            $credentials = [
                'username' => $login,
                'password' => $password
            ];
            // $credentials = $request->only('login', 'password');
            // $credentials = $request->except(['_token']);
            if (Auth::attempt($credentials)) {
                return \redirect()->route('/');
            }
        }

        $user = $this->userService->searchUserByEmail($login);

        if (!empty($user)) {
            // TODO login with email
            // $credentials = [
            //     'email' => $login,
            //     'password' => $password
            // ];
            $credentials = $request->only('login', 'password');
            // $credentials = $request->except(['_token']);
            // if (Auth::attempt($credentials)) {
            if (auth()->attempt($credentials)) {
                return \redirect()->route('/');
            }
        }

        $user = User::where('username', $request->username)->first();


        session()->flash('message', 'invalid credentials');
        return redirect()->back();
    }

    /**
     * ユーザ登録画面表示
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show_signup_form(): mixed
    {
        return view('user.signup');
    }

    /**
     * ユーザ登録処理
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process_signup(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        // TODO : email authentication
        $isCreated = $this->userService->createUser(
            $request->input('firstName'),
            $request->input('LastName'),
            $request->input('username'),
            $request->input('email'),
            $request->input('password')
        );

        if ($isCreated) {
            session()->flash('message', 'Your account was created successfully.');
            return redirect()->route('login');
        }

        session()->flash('message', "There was an error. Your account couldn't be created.");
        return redirect()->route('signup');
    }

    /**
     * ログアウト処理
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        \Auth::logout();
        return redirect()->route('login');
    }
}
