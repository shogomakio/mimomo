<?php

namespace App\Service\User;

use App\Models\IUser;
use App\Repository\User\IRepository;
use App\Service\User\IService;
use Exception;

class Service implements IService
{
    protected $userRepository;

    public function __construct(IRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

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
    ): void {
        $this->userRepository->setUser(
            firstName: $firstName,
            lastName: $lastName,
            username: $username,
            email: $email,
            password: $password,
        );
    }

    /**
     * ユーザ新規登録
     *
     * @return IUser|null
     */
    public function create(): ?IUser
    {
        try {
            $newUser = $this->userRepository->create();
            return $newUser;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * ユーザ取得・Username指定
     *
     * @param string $username
     *
     * @return IUser|null
     */
    public function searchByUsername(string $username): ?IUser
    {
        return $this->userRepository->searchByUsername($username);
    }

    /**
     * ユーザ取得・email指定
     *
     * @param string $email
     *
     * @return IUser|null
     */
    public function searchByEmail(string $email): ?IUser
    {
        return $this->userRepository->searchByEmail($email);
    }

    /**
     * ユーザ取得・メールトークン指定
     *
     * @param string $token
     *
     * @return void
     */
    public function searchByEmailToken(string $token): ?IUser
    {
        return $this->userRepository->searchByEmailToken($token);
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
