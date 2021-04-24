<?php

namespace App\Service\User;

interface IService
{
    /**
     * ユーザ新規登録
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $username
     * @param string $email
     * @param string $password
     *
     * @return User|null
     */
    public function createUser(
        string $firstName,
        string $lastName,
        string $username,
        string $email,
        string $password
    ): ?\App\Models\User;

    /**
     * ユーザ取得・Username指定
     *
     * @param string $username
     *
     * @return \App\Models\User|null
     */
    public function searchUserByUsername(string $username): ?\App\Models\User;

    /**
     * ユーザ取得・email指定
     *
     * @param string $email
     *
     * @return \App\Models\User|null
     */
    public function searchUserByEmail(string $email): ?\App\Models\User;

    /**
     * ユーザ取得・メールトークン指定
     *
     * @param string $token
     *
     * @return \App\Models\User|null
     */
    public function searchUserByEmailToken(string $token): ?\App\Models\User;

    /**
     * メール確認
     *
     * @param integer $id
     *
     * @return boolean
     */
    public function verifyEmail(int $id): bool;
}
