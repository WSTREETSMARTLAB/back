<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'username' => fake()->username(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'location' => fake()->country(),
            'phone' => fake()->phoneNumber(),
            'phone_verified_at' => now(),
            'company_id' => Company::factory(),
            'role' => 'user',
            'active' => true,
            'last_login' => now(),
            'avatar' => fake()->imageUrl(),
            'bio' => fake()->text(),
            'website' => fake()->url,
            'telegram' => fake()->name,
            'facebook' => fake()->url,
            'twitter' => fake()->url,
            'linkedin' => fake()->url,
            'settings' => [],
            'subscription_plan' => $this->faker->randomElement(['free', 'basic', 'premium']),
            'subscription_expires_at' => now()->addDays($this->faker->numberBetween(1, 365)),
            'remember_token' => Str::random(10),
        ];
    }
}
