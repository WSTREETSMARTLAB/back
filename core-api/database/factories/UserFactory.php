<?php

namespace Database\Factories;

use App\Domain\Company\Models\Company;
use App\Domain\User\Models\User;
use App\System\Enums\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\User\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

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
            'name' => $this->faker->userName(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->unique()->numerify('+38##########'),
            'phone_verification_code' => str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'phone_verification_code_expires_at' => $this->faker->dateTimeBetween('now', '+1 hour'),
            'phone_verified_at' => $this->faker->boolean(70) ? $this->faker->dateTimeBetween('-1 year', 'now') : null,
            'country' => $this->faker->countryCode(),
            'city' => $this->faker->city(),
            'language' => $this->faker->languageCode(),
            'address' => json_encode([
                'street' => $this->faker->streetAddress(),
                'zip' => $this->faker->postcode(),
            ]),
            'birth_date' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'experience' => $this->faker->numberBetween(0, 40),
            'avatar' => $this->faker->imageUrl(640, 640, 'people', true),
            'about' => $this->faker->paragraph(),
            'telegram' => '@' . $this->faker->userName(),
            'instagram' => 'https://instagram.com/' . $this->faker->userName(),
            'facebook' => 'https://facebook.com/' . $this->faker->userName(),
        ];
    }
}
