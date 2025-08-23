<?php

namespace Database\Seeders;

use App\Domain\Profile\Models\Profile;
use App\Domain\Tool\Models\Tool;
use App\Domain\User\Models\User;
use Illuminate\Database\Seeder;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::factory()
            ->count(5)
            ->forUser()
            ->verified()
            ->create();

        Tool::factory()->count(5)->create([
            'profile_id' => Profile::inRandomOrder()->first()->id,
        ]);
    }
}
