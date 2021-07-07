<?php

namespace App\Models;

interface IRoom
{
    const TABLE = 'rooms';
    const NAME = 'name';
    const TYPE = 'type';
    const HIDDEN = 'hidden';
    const POSTING_ALLOWED = 'posting_allowed';

    /**
     * Mutator for Room's name
     *
     * @param string $value
     *
     * @return void
     */
    public function setNameAttribute(string $value): void;

    /**
     * Mutator for Room's type
     *
     * @param string $value
     *
     * @return void
     */
    public function setTypeAttribute(string $value): void;

    /**
     * Mutator for Room's hidden
     *
     * @param string $value
     *
     * @return void
     */
    public function setHiddenAttribute(string $value): void;

    /**
     * Mutator for Room's posting allowed
     *
     * @param string $value
     *
     * @return void
     */
    public function setPostingAllowedAttribute(string $value): void;
}
