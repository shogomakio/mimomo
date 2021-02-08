<?php

namespace App\Validation\User;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

trait LoginValidation
{
    /**
     * ログイン情報のバリデーション
     *
     * @param array $data
     *
     * @return RedirectResponse|Validator
     */
    public function validateLoginData(array $data)
    {
        $validator = Validator::make($data, [
            'login' => 'required',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return $validator;
    }
}
