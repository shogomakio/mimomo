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
     * @param string $firstName
     * @param string $lastName
     * @param string $username
     * @param string $email
     * @param string $password
     *
     * @return boolean
     */
    public function create(
        string $firstName,
        string $lastName,
        string $username,
        string $email,
        string $password
    ): ?User {
        $this->user->first_name = $firstName;
        $this->user->last_name = $lastName;
        $this->user->username = $username;
        $this->user->email = $email;
        $this->user->password = $password;
        $this->user->email_verification_token = Str::random(32);
        $is_saved = $this->user->save();
        if ($is_saved) {
            return $this->user;
        }
        return null;
    }

    /**
     * ユーザ検索・username指定
     *
     * @param string $username
     *
     * @return User|null
     */
    public function searchUserByUsername(string $username): User|null
    {
        return $this->user::where('username', $username)->first();
    }

    /**
     *  ユーザ検索・email指定
     *
     * @param string $email
     *
     * @return User|null
     */
    public function searchUserByEmail(string $email): User|null
    {
        return $this->user::where('email', $email)->first();
    }

    /**
     * ユーザ取得・メールトークン指定
     *
     * @param string $token
     *
     * @return User|null
     */
    public function searchUserByEmailToken(string $token): User|null
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
