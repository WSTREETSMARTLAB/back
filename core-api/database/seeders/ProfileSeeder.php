<?php

namespace Database\Seeders;

use App\Domain\Guest\Models\Guest;
use App\Domain\Profile\Models\Profile;
use App\Domain\User\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO fixme
        Profile::factory()
            ->count(5)
            ->forGuest()
            ->forUser()
            ->unverified()
            ->create();

        Profile::factory()
            ->count(10)
            ->forGuest()
            ->forUser()
            ->verified()
            ->recentlyActive()
            ->create();

        Profile::factory()
            ->count(7)
            ->forGuest()
            ->forUser()
            ->verified()
            ->inactive()
            ->create();
    }
}
