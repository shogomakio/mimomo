<?php

namespace App\Repository\User;

use App\Enums\EmailVerificationType;
use App\Models\Interfaces\IUser;
use Carbon\Carbon;

class Repository implements IRepository
{
    protected $user;

    public function __construct(IUser $user)
    {
        $this->user = $user;
    }

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
    ): void {
        $this->user->first_name = $firstName;
        $this->user->last_name = $lastName;
        $this->user->username = $username;
        $this->user->email = $email;
        $this->user->password = $password;
        $this->user->setEmailVerificationTokenAttribute();
    }

    /**
     * ユーザ新規作成
     *
     * @return IUser|null
     */
    public function create(): ?IUser
    {
        try {
            $isNewUserCreated = $this->user->save();
            if (isset($isNewUserCreated) && empty($isNewUserCreated) === false) {
                return $this->user;
            }
            return null;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * ユーザ検索・IUsername指定
     *
     * @param string $IUsername
     *
     * @return IUser|null
     */
    public function searchByUsername(string $username): ?IUser
    {
        return $this->user::where($this->user::USERNAME, $username)->first();
    }

    /**
     *  ユーザ検索・email指定
     *
     * @param string $email
     *
     * @return IUser|null
     */
    public function searchByEmail(string $email): ?IUser
    {
        return $this->user::where($this->user::EMAIL, $email)->first();
    }

    /**
     * ユーザ取得・メールトークン指定
     *
     * @param string $token
     *
     * @return IUser|null
     */
    public function searchByEmailToken(string $token): ?IUser
    {
        return $this->user::where($this->user::EMAIL_VERIFICATION_TOKEN, $token)->first();
    }

    /**
     * メール確認
     *
     * @param integer $id
     *
     * @return integer
     */
    public function verifyEmail(int $id): int
    {
        return $this->user::where($this->user::ID, $id)->update([
            $this->user::EMAIL_VERIFIED => EmailVerificationType::VERIFIED,
            $this->user::EMAIL_VERIFIED_AT => Carbon::now(),
            $this->user::EMAIL_VERIFICATION_TOKEN => ''
        ]);
    }
}
