<?php

namespace App\Repository\User;

use App\Models\User;

interface IRepository
{

    /**
     * ユーザ新規作成
     *
     * @param \App\Models\User $user
     *
     * @return \App\Models\User|null
     */
    public function create(User $user): \App\Models\User|null;

    /**
     * ユーザ検索・username指定
     *
     * @param string $username
     * @return User|null
     */
    public function searchUserByUsername(string $username): \App\Models\User|null;

    /**
     *  ユーザ検索・email指定
     *
     * @param string $email
     *
     * @return \App\Models\User|null
     */
    public function searchUserByEmail(string $email): \App\Models\User|null;

    /**
     * ユーザ取得・メールトークン指定
     *
     * @param string $token
     *
     * @return \App\Models\User|null
     */
    public function searchUserByEmailToken(string $token): \App\Models\User|null;

    /**
     * メール確認
     *
     * @param integer $id
     *
     * @return integer
     */
    public function verifyEmail(int $id): int;
}
