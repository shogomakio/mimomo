<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Service\User\IService;

class VerifyEmailController extends Controller
{

    private $userService;

    public function __construct(IService $userService)
    {
        $this->middleware('guest')->except('user.logout');
        $this->userService = $userService;
    }

    public function verify(string $token = null)
    {
        if (\is_null($token)) {
            session()->flash('message', 'Invalid Login attempt');
            session()->flash('alert-class', 'alert-danger');
            return redirect()->route('user.index');
        }

        $user = $this->userService->searchByEmailToken($token);

        if (\is_null($user)) {
            session()->flash('message', 'Invalid Login attempt');
            session()->flash('alert-class', 'alert-danger');
            return redirect()->route('user.index');
        }

        $this->userService->verifyEmail($user->id);

        session()->flash('message', 'Your account is activated, you can log in now');
        session()->flash('alert-class', 'alert-success');
        return redirect()->route('user.index');
    }
}
