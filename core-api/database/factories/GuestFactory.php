<?php

namespace Database\Factories;

use App\Domain\Guest\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class GuestFactory extends Factory
{
    protected $model = Guest::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'accept_language' => fake()->randomElement(['en-US,en;q=0.9', 'ru-RU,ru;q=0.9', 'es-ES,es;q=0.9']),
            'referer' => fake()->optional(0.7)->url(),
            'host' => fake()->domainName(),
            'path' => fake()->randomElement(['/', '/login', '/register', '/dashboard', '/tools']),
            'method' => fake()->randomElement(['GET', 'POST', 'PUT', 'DELETE']),
            'query' => fake()->optional(0.3)->passthrough(json_encode([
                'utm_source'   => fake()->randomElement(['google','facebook','twitter']),
                'utm_medium'   => fake()->randomElement(['cpc','social','email']),
                'utm_campaign' => fake()->word(),
            ])),
        ];
    }

    /**
     * Guest from mobile device.
     */
    public function mobile(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_agent' => fake()->randomElement([
                'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1',
                'Mozilla/5.0 (Linux; Android 10; SM-G973F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.120 Mobile Safari/537.36',
                'Mozilla/5.0 (iPad; CPU OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1',
            ]),
        ]);
    }

    /**
     * Guest from desktop browser.
     */
    public function desktop(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_agent' => fake()->randomElement([
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            ]),
        ]);
    }

    /**
     * Guest with specific IP range.
     */
    public function fromCountry(string $country): static
    {
        $ips = [
            'US' => ['192.168.1.1', '10.0.0.1', '172.16.0.1'],
            'RU' => ['192.168.1.2', '10.0.0.2', '172.16.0.2'],
            'EU' => ['192.168.1.3', '10.0.0.3', '172.16.0.3'],
        ];

        return $this->state(fn (array $attributes) => [
            'ip' => fake()->randomElement($ips[$country] ?? $ips['US']),
        ]);
    }

    /**
     * Guest with specific referer.
     */
    public function fromReferer(string $referer): static
    {
        return $this->state(fn (array $attributes) => [
            'referer' => $referer,
        ]);
    }
}
