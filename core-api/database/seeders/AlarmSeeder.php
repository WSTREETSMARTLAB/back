<?php

namespace Database\Seeders;

use App\Models\Alarm;
use App\Models\Tool;
use Illuminate\Database\Seeder;

class AlarmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tool = Tool::factory()
            ->count(3)
            ->create();

        Alarm::factory()
            ->count(5)
            ->unresolved()
            ->create([
                'tool_id' => $tool->random()->id,
            ]);

        Alarm::factory()
            ->count(5)
            ->resolved()
            ->create([
                'tool_id' => $tool->random()->id,
            ]);
    }
}
