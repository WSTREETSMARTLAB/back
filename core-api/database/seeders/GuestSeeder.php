<?php

namespace Database\Seeders;

use App\Domain\Guest\Models\Guest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Базовые гостевые записи
        Guest::factory()->count(20)->create();

        // Гости с мобильных устройств
        Guest::factory()
            ->count(10)
            ->mobile()
            ->create();

        // Гости с десктопов
        Guest::factory()
            ->count(15)
            ->desktop()
            ->create();

        // Гости из разных стран
        Guest::factory()
            ->count(5)
            ->fromCountry('US')
            ->create();

        Guest::factory()
            ->count(5)
            ->fromCountry('RU')
            ->create();

        Guest::factory()
            ->count(5)
            ->fromCountry('EU')
            ->create();

        // Гости с конкретными реферерами
        Guest::factory()
            ->count(3)
            ->fromReferer('https://google.com')
            ->create();

        Guest::factory()
            ->count(2)
            ->fromReferer('https://facebook.com')
            ->create();

        Guest::factory()
            ->count(2)
            ->fromReferer('https://twitter.com')
            ->create();
    }
}
