<?php

namespace App\Service;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * ユーザ取得・Username指定
     *
     * @param string $username
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
     * @return \App\Models\User|null
     */
    public function searchUserByEmail(string $email): User|null
    {
        return $this->userRepository->searchUserByEmail($email);
    }

    public function createUser(
        string $firstName,
        string $lastName,
        string $username,
        string $email,
        string $password
    ): bool {
        $user = new User();
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->username = $username;
        $user->email = $email;
        $user->password = $password;
        return $this->userRepository->create($user);
    }

    // public function validate()
}
