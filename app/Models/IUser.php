<?php

namespace App\Models;

interface IUser
{
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
