<?php

namespace Database\Factories;

use App\Domain\Alarm\Models\Alarm;
use App\Domain\Tool\Models\Tool;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Alarm\Models\Alarm>
 */
class AlarmFactory extends Factory
{
    protected $model = Alarm::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(\App\Domain\Alarm\Enums\Alarm::cases());

        return [
            'type' => $type->value,
            'tool_id' => Tool::factory(),
            'value' => $this->faker->randomFloat(2, 10, 40),
            'start' => now()->subMinutes(rand(5, 120)),
            'end' => rand(0, 1) ? now() : null,
            'resolved' => (bool) rand(0, 1),
        ];
    }

    public function unresolved(): static
    {
        return $this->state(fn () => [
            'resolved' => false,
            'end' => null,
        ]);
    }

    public function resolved(): static
    {
        return $this->state(fn () => [
            'resolved' => true,
            'end' => now(),
        ]);
    }
}
