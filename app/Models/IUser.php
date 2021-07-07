<?php

namespace App\Models;

interface IUser
{
    const TABLE = 'users';
    const ID = 'id';
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const USERNAME = 'username';
    const EMAIL = 'email';
    const EMAIL_VERIFIED = 'email_verified';
    const EMAIL_VERIFIED_AT = 'email_verified_at';
    const EMAIL_VERIFICATION_TOKEN = 'email_verification_token';
    const PROFILE_PICTURE = 'profile_picture';
    const PASSWORD = 'password';
    const REMEMBER_TOKEN = 'remember_token';

    /**
     * Mutator for User's first name
     *
     * @param string $value
     *
     * @return void
     */
    public function setFirstNameAttribute(string $value): void;

    /**
     * Mutator for User's last name
     *
     * @param string $value
     *
     * @return void
     */
    public function setLastNameAttribute(string $value): void;

    /**
     * Mutator for User's username
     *
     * @param string $value
     *
     * @return void
     */
    public function setUsernameAttribute(string $value): void;

    /**
     * Mutator for User's email
     *
     * @param string $value
     *
     * @return void
     */
    public function setEmailAttribute(string $value): void;

    /**
     * Mutator for User's password
     *
     * @param string $value
     *
     * @return void
     */
    public function setPasswordAttribute(string $value): void;

    /**
     * Mutator for User's Email Verification Token
     *
     * @return void
     */
    public function setEmailVerificationTokenAttribute(): void;
}
