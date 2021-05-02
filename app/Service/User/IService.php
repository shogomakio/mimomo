<?php

namespace App\Service\User;

use App\Models\IUser;

interface IService
{

    /**
     * ユーザ model を設定
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $username
     * @param string $email
     * @param string $password
     *
     * @return void
     */
    public function setUser(
        string $firstName,
        string $lastName,
        string $username,
        string $email,
        string $password
    ): void;

    /**
     * ユーザ新規登録
     *
     * @return IUser
     */
    public function create(): ?IUser;

    /**
     * ユーザ取得・Username指定
     *
     * @param string $username
     *
     * @return IUser|null
     */
    public function searchByUsername(string $username): ?IUser;

    /**
     * ユーザ取得・email指定
     *
     * @param string $email
     *
     * @return IUser|null
     */
    public function searchByEmail(string $email): ?IUser;

    /**
     * ユーザ取得・メールトークン指定
     *
     * @param string $token
     *
     * @return IUser|null
     */
    public function searchByEmailToken(string $token): ?IUser;

    /**
     * メール確認
     *
     * @param integer $id
     *
     * @return boolean
     */
    public function verifyEmail(int $id): bool;
}
