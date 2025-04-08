<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Owner;


class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 1 restaurant for each owner
        $owners = Owner::all();
        foreach ($owners as $owner) {
            Restaurant::factory()
                ->count(1)
                ->create([
                    'owner_id' => $owner->id, // Associate the restaurant with the owner
                ]);
        }


       

    }
}
