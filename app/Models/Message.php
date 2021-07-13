<?php

namespace App\Models;

use App\Models\Interfaces\IMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model implements IMessage
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        self::CONVERSATION_ID,
        self::USER_ID,
        self::MESSAGE
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        self::IS_READ => 'boolean',
        self::IS_CHANGED => 'boolean',
    ];
}
