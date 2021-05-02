<?php

namespace App\Repository\User;

use App\Models\IUser;

interface IRepository
{

    /**
     * ユーザ Model 情報を設定
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
     * ユーザ新規作成
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $username
     * @param string $email
     * @param string $password
     *
     * @return IUser|null
     */
    public function create(): ?IUser;

    /**
     * ユーザ検索・username指定
     *
     * @param string $username
     *
     * @return IUser|null
     */
    public function searchByUsername(string $username): ?IUser;

    /**
     *  ユーザ検索・email指定
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
     * @return integer
     */
    public function verifyEmail(int $id): int;
}
