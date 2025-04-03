<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereIn('subscription_plan', ['basic', 'premium'])->get();

        foreach ($users as $user) {
            if ($user->subscription_plan === 'basic') {
                Company::factory()->create(['owner_user_id' => $user->id]);
            }

            if ($user->subscription_plan === 'premium') {
                Company::factory()->count(rand(1, 3))->create(['owner_user_id' => $user->id]);
            }
        }
    }
}
