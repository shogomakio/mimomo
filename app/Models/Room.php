<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model implements IRoom
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        self::NAME,
        self::TYPE,
        self::HIDDEN,
        self::POSTING_ALLOWED
    ];


}
