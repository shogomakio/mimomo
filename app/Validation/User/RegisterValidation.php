<?php

namespace App\Validation\User;

use Illuminate\Support\Facades\Validator;

trait RegisterValidation
{
    /**
     * ユーザ登録情報のバリデーション
     *
     * @param array $input
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateRegisterData(array $input): \Illuminate\Contracts\Validation\Validator
    {
        $validator = Validator::make($input, [
            'firstName' => 'required',
            'lastName' => 'required',
            'username' => 'required|min:5|unique:users,username,NULL,id,deleted_at,NULL',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|min:8|confirmed'
        ]);

        return $validator;
    }
}
