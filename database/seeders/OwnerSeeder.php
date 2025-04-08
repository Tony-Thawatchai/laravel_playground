<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Owner;
use App\Models\User;


class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 owners with associated users and restaurants
        Owner::factory()
            ->count(10)
            ->create([
                'user_id' => User::factory(), // Create a new user for the owner
                
            ]);
    }
}
