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
            'username' => 'required|unique:users,deleted_at,null',
            'email' => 'required|email|unique:users,deleted_at,null',
            'password' => 'required|min:8|confirmed'
        ]);

        return $validator;
    }
}
