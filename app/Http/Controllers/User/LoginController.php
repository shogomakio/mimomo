<?php

namespace App\Http\Controllers\User;

use App\Enums\EmailVerificationType;
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
        $this->middleware('guest')->except('logout');
        $this->userService = $userService;
    }

    /**
     * ログイン画面表示
     */
    public function showLoginForm()
    {
        return view('user.authentication.login');
    }

    /**
     * ログイン処理
     *
     * @param \Illuminate\Http\Request $request リクエスト
     */
    public function processLogin(Request $request)
    {
        try {
            $this->validateLoginData($request->except('_token'));

            $login = $request->only('login')['login'];
            $password = $request->only('password')['password'];

            // usernameでログイン
            $user = $this->userService->searchUserByUsername($login);
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
            $user = $this->userService->searchUserByEmail($login);
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

            session()->flash('message', 'invalid credentials');
            session()->flash('type', 'danger');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('message', 'invalid credentials');
            session()->flash('type', 'danger');
            return redirect()->back();
        }
    }

    /**
     * ログアウト処理
     */
    public function logout()
    {
        \Auth::logout();
        return redirect()->route('user.login');
    }
}
