<?php

namespace App\Validation\User;

use Illuminate\Support\Facades\Validator;

trait LoginValidation
{
    /**
     * ログイン情報のバリデーション
     *
     * @param array $input
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateLoginData(array $input): \Illuminate\Contracts\Validation\Validator
    {
        $validator = Validator::make($input, [
            'login' => 'required',
            'password' => 'required',
        ]);

        return $validator;
    }
}
