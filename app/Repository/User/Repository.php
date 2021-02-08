<?php

namespace App\Repository\User;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Repository implements IRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * ユーザ新規作成
     *
     * @param \App\Models\User $user
     *
     * @return \App\Models\User|null
     */
    public function create(User $user): \App\Models\User|null
    {
        return $this->user::create([
            'first_name' => trim($user->first_name),
            'last_name' => trim($user->last_name),
            'username' => trim($user->username),
            'email' => strtolower($user->email),
            'password' => bcrypt($user->password),
            'email_verification_token' => Str::random(32),
        ]);
    }

    /**
     * ユーザ検索・username指定
     *
     * @param string $username
     *
     * @return \App\Models\User|null
     */
    public function searchUserByUsername(string $username): \App\Models\User|null
    {
        return $this->user::where('username', $username)->first();
    }

    /**
     *  ユーザ検索・email指定
     *
     * @param string $email
     *
     * @return \App\Models\User|null
     */
    public function searchUserByEmail(string $email): \App\Models\User|null
    {
        return $this->user::where('email', $email)->first();
    }

    /**
     * ユーザ取得・メールトークン指定
     *
     * @param string $token
     *
     * @return \App\Models\User|null
     */
    public function searchUserByEmailToken(string $token): \App\Models\User|null
    {
        return $this->user::where('email_verification_token', $token)->first();
    }

    /**
     * メール確認
     *
     * @param integer $id
     *
     * @return integer
     */
    public function verifyEmail(int $id): int
    {
        return $this->user::where('id', $id)->update([
            'email_verified' => 1,
            'email_verified_at' => Carbon::now(),
            'email_verification_token' => ''
        ]);
    }
}
