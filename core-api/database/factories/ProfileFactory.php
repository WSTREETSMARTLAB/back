<?php

namespace Database\Factories;

use App\Domain\Company\Models\Company;
use App\Domain\Guest\Models\Guest;
use App\Domain\Profile\Models\Profile;
use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class ProfileFactory extends Factory
{
    protected $model = Profile::class;
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
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'email_verification_code' => str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'email_verification_code_expires_at' => now()->addMinutes(10),
            'email_verified_at' => now(),
            'owner_type' => User::class,
            'owner_id' => User::factory(),
            'active' => true,
            'last_login' => now(),
            'guest_id' => null,
        ];
    }

    /**
     * Profile for verified user.
     */
    public function verified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => now(),
            'active' => true,
            'email_verification_code' => null,
            'email_verification_code_expires_at' => null,
        ]);
    }

    /**
     * Profile for unverified user.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
            'active' => false,
            'email_verification_code' => str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'email_verification_code_expires_at' => now()->addMinutes(10),
        ]);
    }

    /**
     * Profile with expired verification code.
     */
    public function expiredVerification(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
            'active' => false,
            'email_verification_code' => str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'email_verification_code_expires_at' => now()->subMinutes(5),
        ]);
    }

    /**
     * Profile for guest user.
     */
    public function forGuest(): static
    {
        return $this->state(fn (array $attributes) => [
            'guest_id' => Guest::factory(),
        ]);
    }

    /**
     * Profile for regular user.
     */
    public function forUser(): static
    {
        return $this->state(fn (array $attributes) => [
            'owner_type' => User::class,
            'owner_id' => User::factory(),
        ]);
    }

    public function forCompany(): static
    {
        return $this->state(fn (array $attributes) => [
            'owner_type' => Company::class,
            'owner_id' => Company::factory(),
        ]);
    }

    /**
     * Profile with recent login.
     */
    public function recentlyActive(): static
    {
        return $this->state(fn (array $attributes) => [
            'last_login' => now()->subMinutes(fake()->numberBetween(1, 60)),
        ]);
    }

    /**
     * Profile with old login.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'last_login' => now()->subDays(fake()->numberBetween(7, 90)),
        ]);
    }
}
