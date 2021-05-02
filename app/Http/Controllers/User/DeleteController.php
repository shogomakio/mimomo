<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Service\User\IService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DeleteController extends Controller
{
    private $userService;

    public function __construct(IService $userService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
    }

    public function showDeleteInformation()
    {
        return view('user.delete');
    }

    /**
     * ログイン処理
     *
     * @param \Illuminate\Http\Request $request リクエスト
     */
    public function processDelete()
    {
        try {
            $user = Auth::user();
            $user->delete();
            session()->flash('message', 'account deleted successfully');
            session()->flash('type', 'success');
            return view('user.login');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('message', 'invalid credentials');
            session()->flash('type', 'danger');
            return redirect()->back();
        }
    }
}
