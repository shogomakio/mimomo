<?php

namespace App\Models\Interfaces;

interface IConversation
{
    const TABLE = 'conversations';
    const NAME = 'name';
    const TYPE = 'type';
    const HIDDEN = 'hidden';
    const POSTING_ALLOWED = 'posting_allowed';

    /**
     * Mutator for Conversation's name
     *
     * @param string $value
     *
     * @return void
     */
    public function setNameAttribute(string $value): void;
}
