<?php

namespace App\Http\Controllers\User;

use App\Enums\EmailVerificationType;
use App\Http\Controllers\Controller;
use App\Service\User\IService;
use App\Validation\User\LoginValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use LoginValidation;

    private $userService;

    public function __construct(IService $userService)
    {
        $this->middleware('guest')->except('logout');
        $this->userService = $userService;
    }

    public function index()
    {
        return view('user.authentication.login');
    }

    /**
     * ログイン処理
     *
     * @param \Illuminate\Http\Request $request リクエスト
     */
    public function login(Request $request)
    {
        try {
            $this->validateLoginData($request->except('_token'));

            $login = $request->only('login')['login'];
            $password = $request->only('loginPassword')['loginPassword'];

            // usernameでログイン
            $user = $this->userService->searchByUsername($login);
            if (is_null($user) === false && \boolval($user->email_verified)) {
                // 有効なusernameだったら、ログイン実行
                $credentials = [
                    'username' => $login,
                    'password' => $password,
                    'email_verified' => EmailVerificationType::VERIFIED
                ];

                if (Auth::attempt($credentials)) {
                    return \redirect()->route('/');
                }
            }

            // emailでログイン
            $user = $this->userService->searchByEmail($login);
            if (is_null($user) === false && \boolval($user->email_verified)) {
                // 有効なemailだったら、ログイン実行
                $credentials = [
                    'email' => $login,
                    'password' => $password,
                    'email_verified' => EmailVerificationType::VERIFIED
                ];

                if (Auth::attempt($credentials)) {
                    return \redirect()->route('/');
                }
            }
            session()->flash('loginErrorMessage', 'invalid credentials');
            session()->flash('alert-class', 'alert-danger');
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('loginErrorMessage', 'invalid credentials');
            session()->flash('alert-class', 'alert-danger');
            return redirect()->back()->withInput();
        }
    }

    /**
     * ログアウト処理
     */
    public function logout()
    {
        \Auth::logout();
        return redirect()->route('home');
    }
}
