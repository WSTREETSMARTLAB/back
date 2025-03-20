<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'location' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'phone_verified_at' => $this->faker->boolean(70) ? now() : null,
            'tax_id' => $this->faker->boolean(70) ? $this->faker->unique()->numerify('########') : null,
            'activities' => json_encode($this->faker->randomElements([
                'agriculture', 'iot', 'hydroponics', 'biotech', 'smart_farming'
            ], $this->faker->numberBetween(1, 3)), JSON_THROW_ON_ERROR),
            'email' => $this->faker->unique()->companyEmail(),
            'email_verified_at' => $this->faker->boolean(80) ? now() : null,
            'active' => true,
            'logo' => $this->faker->imageUrl(200, 200, 'business'),
            'description' => $this->faker->paragraph(),
            'website' => $this->faker->optional()->url(),
            'telegram' => '@' . $this->faker->userName(),
            'facebook' => $this->faker->optional()->url(),
            'linkedin' => $this->faker->optional()->url(),
            'twitter' => $this->faker->optional()->url(),
            'settings' => json_encode([
                'auto_approve_users' => $this->faker->boolean(),
                'allow_public_profile' => $this->faker->boolean(),
            ], JSON_THROW_ON_ERROR),
            'owner_user_id' => User::factory(),
        ];
    }
}
