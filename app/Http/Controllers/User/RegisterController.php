<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\User\EmailVerification;
use App\Service\User\IService;
use App\Validation\User\RegisterValidation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    use RegisterValidation;

    private $userService;

    public function __construct(IService $userService)
    {
        $this->middleware('guest');
        $this->userService = $userService;
    }

    /**
     * ユーザ登録画面表示
     *
     */
    public function index()
    {
        return view('user.authentication.signup');
    }

    /**
     * ユーザ登録処理
     *
     * @param \Illuminate\Http\Request $request リクエスト
     */
    public function signup(Request $request)
    {
        try {
            $validator = $this->validateRegisterData($request->all());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $this->userService->setUser(
                firstName: $request->input('firstName'),
                lastName: $request->input('lastName'),
                username: $request->input('username'),
                email: $request->input('email'),
                password: $request->input('password')
            );
            DB::beginTransaction();
            $user = $this->userService->create();

            if (is_null($user)) {
                session()->flash('message', "There was an error. Your account couldn't be created.");
                session()->flash('alert-class', 'alert-danger');
                return redirect()->route('user.signup');
            }

            \Mail::to($user->email)->send(new EmailVerification($user));
            session()->flash(
                'message',
                'Your account was created successfully. Please check your email to activate your account.'
            );
            session()->flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            session()->flash('message', 'Something went wrong. Could not be registered');
            session()->flash('alert-class', 'alert-danger');
            return redirect()->back()->withInput();
        }
    }
}
