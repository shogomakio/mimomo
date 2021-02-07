<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\User\VerificationEmail;
use App\Service\User\IService;
use App\Validation\User\RegisterValidation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegisterValidation;

    private $userService;

    public function __construct(IService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * ユーザ登録画面表示
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showSignupForm(): mixed
    {
        return view('user.authentication.signup');
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
        $this->validateRegisterData($request);
        // $this->validateRegisterData($request->all());

        $user = $this->userService->createUser(
            $request->input('firstName'),
            $request->input('lastName'),
            $request->input('username'),
            $request->input('email'),
            $request->input('password')
        );

        if (is_null($user)) {
            session()->flash('message', "There was an error. Your account couldn't be created.");
            return redirect()->route('user.signup');
        }

        // TODO make sure the email is sent correctly
        \Mail::to($user->email)->send(new VerificationEmail($user));
        session()->flash(
            'message',
            'Your account was created successfully. Please check your email to activate your account.'
        );
        return redirect()->back();
    }
}
