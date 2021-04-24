<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'email_verified',
        'email_verified_at',
        'email_verification_token',
        'profile_picture',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Mutator for User's first name
     *
     * @param string $value
     *
     * @return void
     */
    public function setFirstNameAttribute(string $value): void
    {
        $this->attributes['first_name'] = \trim($value);
    }

    /**
     * Mutator for User's last name
     *
     * @param string $value
     *
     * @return void
     */
    public function setLastNameAttribute(string $value): void
    {
        $this->attributes['last_name'] = \trim($value);
    }

    /**
     * Mutator for User's username
     *
     * @param string $value
     *
     * @return void
     */
    public function setUsernameAttribute(string $value): void
    {
        $this->attributes['username'] = \trim($value);
    }

    /**
     * Mutator for User's email
     *
     * @param string $value
     *
     * @return void
     */
    public function setEmailAttribute(string $value): void
    {
        $this->attributes['email'] = \strtolower($value);
    }

    /**
     * Mutator for User's password
     *
     * @param string $value
     *
     * @return void
     */
    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password'] = \bcrypt($value);
    }
}
