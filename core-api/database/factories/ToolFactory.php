<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tool>
 */
class ToolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement([
                'room_stat', // todo create enum
            ]),
            'user_id' => User::factory(),
            'company_id' => fn () => Company::query()->inRandomOrder()->first()?->id,
//            'room_id' => fn () => Room::query()->inRandomOrder()->first()?->id,
            'is_active' => $this->faker->boolean(70),
            'code' => strtoupper(Str::random(10)),
            'activated_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'name' => $this->faker->optional()->word,
            'location_note' => $this->faker->optional()->sentence,
            'last_online_at' => $this->faker->optional()->dateTimeBetween('-7 days', 'now'),
            'firmware_version' => $this->faker->optional()->numerify('v#.##'),
            'meta' => [
                'sensitivity' => $this->faker->numberBetween(1, 10),
                'threshold' => $this->faker->randomFloat(1, 0, 100),
                'unit' => $this->faker->randomElement(['C°', '%', 'lux', 'ppm']),
            ],
        ];
    }
}
