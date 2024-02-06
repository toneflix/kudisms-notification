<?php

namespace ToneflixCode\KudiSmsNotification\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use ToneflixCode\KudiSmsNotification\Tests\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $phones = explode(',', config('kudi-notification.test_numbers'));
        $seed = rand(0, count($phones) - 1);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $phones[$seed] ?? $this->faker->phoneNumber,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
