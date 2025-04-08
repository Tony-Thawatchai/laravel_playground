<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Restaurant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\membership>
 */
class MembershipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // create membership for each customer to existing restaurant
            'customer_id' => Customer::factory(), // Create a new customer for the membership
            'restaurant_id' => Restaurant::factory(), // Create a new restaurant for the membership
            'points' => $this->faker->numberBetween(0, 100), // Random points between 0 and 100

        ];
    }
}
