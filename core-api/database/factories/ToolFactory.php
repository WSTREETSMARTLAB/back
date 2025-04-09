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
        $minTemp = $this->faker->randomFloat(1, 5, 15);
        $maxTemp = $this->faker->randomFloat(1, $minTemp + 1, 30);

        $minHum = $this->faker->numberBetween(20, 40);
        $maxHum = $this->faker->numberBetween($minHum + 10, 80);

        $lightDay = $this->faker->numberBetween(90, 100);
        $lightNight = $this->faker->numberBetween(1, 10);

        $dayStart = $this->faker->randomElement(['06:00', '07:00', '08:00']);
        $dayEnd = $this->faker->randomElement(['18:00', '19:00', '20:00']);

        return [
            'type' => $this->faker->randomElement(['room-stat']),
            'name' => $this->faker->word,
            'user_id' => User::factory(),
            'company_id' => fn () => Company::query()->inRandomOrder()->first()?->id,
//          'room_id' => fn () => Room::query()->inRandomOrder()->first()?->id,
            'active' => $this->faker->boolean(70),
            'code' => strtoupper(
                implode('-', [
                    Str::upper(Str::random(4)),
                    Str::upper(Str::random(4))
                ])
            ),
            'activated_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'location_note' => $this->faker->optional()->sentence,
            'last_online_at' => $this->faker->optional()->dateTimeBetween('-7 days', 'now'),
            'firmware_version' => $this->faker->optional()->numerify('v#.##'),
            'settings' => [
                'min_temp' => $minTemp,
                'max_temp' => $maxTemp,
                'min_hum' => $minHum,
                'max_hum' => $maxHum,
                'light_day_threshold' => $lightDay,
                'light_night_threshold' => $lightNight,
                'day_start' => $dayStart,
                'day_end' => $dayEnd,
            ],
        ];
    }
}
