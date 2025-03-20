<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'subscription_plan' => 'premium',
            'subscription_expires_at' => now()->addYear(),
            'active' => true,
        ]);
    }
}
