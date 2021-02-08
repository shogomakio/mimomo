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
     * @return \App\Models\User|null
     */
    public function createUser(
        string $firstName,
        string $lastName,
        string $username,
        string $email,
        string $password
    ): \App\Models\User|null {
        $user = new User();
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->username = $username;
        $user->email = $email;
        $user->password = $password;
        return $this->userRepository->create($user);
    }

    /**
     * ユーザ取得・Username指定
     *
     * @param string $username
     *
     * @return \App\Models\User|null
     */
    public function searchUserByUsername(string $username): User|null
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
    public function searchUserByEmail(string $email): User|null
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
    public function searchUserByEmailToken(string $token): \App\Models\User|null
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
