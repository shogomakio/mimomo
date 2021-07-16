<?php

namespace App\Models\Interfaces;

interface IMessage
{
    const ID = 'id';
    const CONVERSATION_ID = 'conversation_id';
    const USER_ID = 'user_id';
    const MESSAGE = 'message';
    const IS_READ = 'is_read';
    const IS_CHANGED = 'is_changed';
}
