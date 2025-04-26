<?php

namespace Database\Seeders;

use App\Models\Tool;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(5)
            ->has(
                Tool::factory()
                    ->count(3)
            )
            ->create();

        Tool::factory()->count(5)->create([
            'user_id' => User::inRandomOrder()->first()->id,
            'company_id' => null,
        ]);

        $adminUser = User::query()->where('email', 'lab@wstreet.com')->first();

        Tool::factory()->count(3)->create([
            'user_id' => $adminUser->id,
            'active' => true
        ]);
    }
}
