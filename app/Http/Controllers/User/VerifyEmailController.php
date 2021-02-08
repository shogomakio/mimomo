<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Service\User\IService;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{

    private $userService;

    public function __construct(IService $userService)
    {
        $this->middleware('guest')->except('user.logout');
        $this->userService = $userService;
    }

    public function verifyEmail(string $token = null)
    {
        if ($token == null) {
            session()->flash('message', 'Invalid Login attempt');
            session()->flash('type', 'danger');
            return redirect()->route('user.login');
        }

        $user = $this->userService->searchUserByEmailToken($token);

        if ($user == null) {
            session()->flash('message', 'Invalid Login attempt');
            session()->flash('type', 'danger');
            return redirect()->route('user.login');
        }

        $this->userService->verifyEmail($user->id);

        session()->flash('message', 'Your account is activated, you can log in now');
        session()->flash('type', 'success');
        return redirect()->route('user.login');
    }
}
