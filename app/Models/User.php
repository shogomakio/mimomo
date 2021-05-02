<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements IUser
{
    use HasFactory, Notifiable, SoftDeletes;

    public $timestamps = true;

    public const ID = 'id';
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const USERNAME = 'username';
    public const EMAIL = 'email';
    public const EMAIL_VERIFIED = 'email_verified';
    public const EMAIL_VERIFIED_AT = 'email_verified_at';
    public const EMAIL_VERIFICATION_TOKEN = 'email_verification_token';
    public const PROFILE_PICTURE = 'profile_picture';
    public const PASSWORD = 'password';
    public const REMEMBER_TOKEN = 'remember_token';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::FIRST_NAME,
        self::LAST_NAME,
        self::USERNAME,
        self::EMAIL,
        self::EMAIL_VERIFIED,
        self::EMAIL_VERIFIED_AT,
        self::EMAIL_VERIFICATION_TOKEN,
        self::PROFILE_PICTURE,
        self::PASSWORD,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        self::PASSWORD,
        self::REMEMBER_TOKEN,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        self::EMAIL_VERIFIED => 'boolean',
        self::EMAIL_VERIFIED_AT => 'datetime',
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
        $this->attributes[self::FIRST_NAME] = \trim($value);
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
        $this->attributes[self::LAST_NAME] = \trim($value);
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
        $this->attributes[self::USERNAME] = \trim($value);
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
        $this->attributes[self::EMAIL] = \strtolower($value);
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
        $this->attributes[self::PASSWORD] = \bcrypt($value);
    }

    /**
     * Mutator for User's Email Verification Token
     *
     * @param integer $token_length
     *
     * @return void
     */
    public function setEmailVerificationTokenAttribute(int $token_length = 32): void
    {
        $this->attributes[self::EMAIL_VERIFICATION_TOKEN] = Str::random($token_length);
    }
}
