<?php

namespace App\Models;

use App\Models\Interfaces\IConversation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model implements IConversation
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        self::NAME,
        self::TYPE,
        self::HIDDEN,
        self::POSTING_ALLOWED
    ];

    protected $casts = [
        self::HIDDEN => 'boolean',
        self::POSTING_ALLOWED => 'boolean',
    ];

    public function setNameAttribute(string $value): void
    {
        $this->attributes[self::NAME] = \trim($value);
    }
}
