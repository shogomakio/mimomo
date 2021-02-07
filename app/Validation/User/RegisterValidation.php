<?php

namespace App\Validation\User;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

trait RegisterValidation
{
    /**
     * ユーザ登録情報のバリデーション
     *
     * @param array $data
     *
     * @return RedirectResponse|Validator
     */
    public function validateRegisterData(Request $request): void
    {
        // $validator = Validator::make($data, [
        //     'firstName' => 'required',
        //     'lastName' => 'required',
        //     'username' => 'required',
        //     'email' => 'required',
        //     'password' => 'required|min:8|confirmed'
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        $request->validate(
            [
                'firstName' => 'required',
                'lastName' => 'required',
                'username' => 'required',
                'email' => 'required',
                'password' => 'required|min:8|confirmed'
            ]
        );
    }
}
