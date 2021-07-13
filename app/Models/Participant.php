<?php

namespace App\Models;

use App\Models\Interfaces\IParticipant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model implements IParticipant
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        self::CONVERSATION_ID,
        self::USER_ID
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setConversationIdAttribute(int $value): void
    {
        $this->attributes[self::CONVERSATION_ID] = $value;
    }

    public function setUserIdAttribute(int $value): void
    {
        $this->attributes[self::USER_ID] = $value;
    }
}
