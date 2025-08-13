<?php

namespace Database\Seeders;

use App\Domain\User\Models\User;
use App\System\Enums\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create(['subscription_plan' => 'free']);
        User::factory()->count(5)->create(['subscription_plan' => 'basic']);
        User::factory()->count(5)->create(['subscription_plan' => 'premium']);

        User::factory()->create([
            'name' => 'wstreet_lab',
            'username' => 'admin',
            'email' => 'lab@wstreet.com',
            'password' => Hash::make('securepassword123'),
            'role' => Role::Admin->value,
            'subscription_plan' => 'premium',
            'subscription_expires_at' => now()->addYear(),
            'active' => true,
        ]);
    }
}
