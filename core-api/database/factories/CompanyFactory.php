<?php

namespace Database\Factories;

use App\Domain\Company\Models\Company;
use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Company\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'phone' => $this->faker->optional()->numerify('+38##########'), // формат можно подогнать
            'phone_verification_code' => str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'phone_verification_code_expires_at' => $this->faker->optional()->dateTimeBetween('now', '+1 hour'),
            'phone_verified_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),

            'legal_name' => $this->faker->company() . ' LTD',
            'edrpou' => str_pad((string)random_int(0, 99999999), 8, '0', STR_PAD_LEFT),
            'inn' => str_pad((string)random_int(0, 999999999999), 12, '0', STR_PAD_LEFT),
            'registration_number' => strtoupper(Str::random(10)),
            'registration_date' => $this->faker->optional()->date(),

            'country' => $this->faker->countryCode(),
            'city' => $this->faker->city(),

            'legal_address' => json_encode([
                'street' => $this->faker->streetAddress(),
                'zip' => $this->faker->postcode(),
            ]),
            'actual_address' => json_encode([
                'street' => $this->faker->streetAddress(),
                'zip' => $this->faker->postcode(),
            ]),

            'business_type' => $this->faker->randomElement(['ФОП', 'ТОВ', 'ПАТ']),
            'specialization' => $this->faker->randomElement(['растениеводство', 'животноводство', 'техника']),

            'experience' => $this->faker->numberBetween(0, 50),

            'contact_person' => $this->faker->name(),
            'contact_phone' => $this->faker->phoneNumber(),
            'contact_email' => $this->faker->safeEmail(),

            'employees_count' => $this->faker->numberBetween(1, 1000),

            'avatar' => $this->faker->imageUrl(640, 640, 'business', true),
            'website' => $this->faker->optional()->url(),

            'telegram' => '@' . $this->faker->userName(),
            'facebook' => 'https://facebook.com/' . $this->faker->userName(),
            'instagram' => 'https://instagram.com/' . $this->faker->userName(),
            'linkedin' => 'https://linkedin.com/in/' . $this->faker->userName(),
            'twitter' => 'https://twitter.com/' . $this->faker->userName(),

            'about' => $this->faker->paragraphs(2, true),
        ];
    }
}
