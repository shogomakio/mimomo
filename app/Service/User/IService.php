<?php

namespace App\Service\User;

interface IService
{
    /**
     * ユーザ取得・Username指定
     *
     * @param string $username
     *
     * @return \App\Models\User|null
     */
    public function searchUserByUsername(string $username): \App\Models\User|null;

    /**
     * ユーザ取得・email指定
     *
     * @param string $email
     *
     * @return \App\Models\User|null
     */
    public function searchUserByEmail(string $email): \App\Models\User|null;

    /**
     * ユーザ新規登録
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $username
     * @param string $email
     * @param string $password
     *
     * @return boolean
     */
    public function createUser(
        string $firstName,
        string $lastName,
        string $username,
        string $email,
        string $password
    ): bool;
}
