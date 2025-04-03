<?php

namespace Database\Factories;

use App\Enums\Role;
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
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verification_code' => (string) random_int(1000, 999999),
            'email_verification_code_expires_at' => now()->addMinutes(10),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'location' => fake()->country(),
            'phone' => fake()->phoneNumber(),
            'phone_verification_code' => (string) random_int(1000, 999999),
            'phone_verification_code_expires_at' => now()->addMinutes(10),
            'phone_verified_at' => now(),
            'company_id' => $this->faker->boolean(50) ? Company::factory() : null,
            'role' => Role::User->value,
            'active' => true,
            'last_login' => now(),
            'avatar' => fake()->imageUrl(),
            'bio' => fake()->text(),
            'website' => fake()->url(),
            'telegram' => '@' . fake()->userName(),
            'facebook' => fake()->url(),
            'twitter' => fake()->url(),
            'linkedin' => fake()->url(),
            'settings' => json_encode([
                'allow_public_profile' => $this->faker->boolean(),
            ], JSON_THROW_ON_ERROR),
            'subscription_plan' => $this->faker->randomElement(['free', 'basic', 'premium']),
            'subscription_expires_at' => now()->addDays($this->faker->numberBetween(1, 365)),
            'remember_token' => Str::random(10),
        ];
    }
}
