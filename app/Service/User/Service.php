<?php

namespace App\Service\User;

use App\Models\User;
use App\Repository\User\IRepository;
use App\Service\User\IService;

class Service implements IService
{
    protected $userRepository;

    public function __construct(IRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

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
    ): ?User {
        return $this->userRepository->create(
            firstName: $firstName,
            lastName: $lastName,
            username: $username,
            email: $email,
            password: $password,
        );
    }

    /**
     * ユーザ取得・Username指定
     *
     * @param string $username
     *
     * @return \App\Models\User|null
     */
    public function searchUserByUsername(string $username): ?User
    {
        return $this->userRepository->searchUserByUsername($username);
    }

    /**
     * ユーザ取得・email指定
     *
     * @param string $email
     *
     * @return \App\Models\User|null
     */
    public function searchUserByEmail(string $email): ?User
    {
        return $this->userRepository->searchUserByEmail($email);
    }

    /**
     * ユーザ取得・メールトークン指定
     *
     * @param string $token
     *
     * @return void
     */
    public function searchUserByEmailToken(string $token): ?User
    {
        return $this->userRepository->searchUserByEmailToken($token);
    }

    /**
     * メール確認
     *
     * @param integer $id
     *
     * @return boolean
     */
    public function verifyEmail(int $id): bool
    {
        $result = $this->userRepository->verifyEmail($id);
        return $result > 0;
    }
}
