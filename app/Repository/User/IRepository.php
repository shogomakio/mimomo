<?php

namespace App\Repository\User;

use App\Models\User;

interface IRepository
{

    /**
     * ユーザ新規作成
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $username
     * @param string $email
     * @param string $password
     *
     * @return User|null
     */
    public function create(
        string $firstName,
        string $lastName,
        string $username,
        string $email,
        string $password
    ): ?User;

    /**
     * ユーザ検索・username指定
     *
     * @param string $username
     *
     * @return User|null
     */
    public function searchUserByUsername(string $username): User|null;

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
