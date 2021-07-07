<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $order = 1;
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->unique()->safeEmail,
            'email' => 'example+' . $order++ . '@mail.com',
            'email_verified' => true,
            'email_verified_at' => now(),
            'email_verification_token' => \random_int(1, 32),
            'password' => 'secret', // password
            'remember_token' => Str::random(10),
        ];
    }
}
