<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Owner;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'zip_code' => $this->faker->postcode(),
            'food_type' => $this->faker->word(),
            'average_bill_amount' => $this->faker->randomFloat(2, 10, 100),
            // Assuming you have an Owner model and factory
            'owner_id' => Owner::factory(), // Create a new owner for each restaurant
            // or you can use a specific owner ID if you want to associate with an existing owner
            // 'owner_id' => Owners::factory()->create()->id, // Create and associate with an existing owner

        ];
    }
}
