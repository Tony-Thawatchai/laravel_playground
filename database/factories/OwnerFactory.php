<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\owner>
 */
class OwnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        
            'phone' => $this->faker->phoneNumber(),
            'user_id' => User::factory(), // Create a new user for the owner
            'credit' => $this->faker->numberBetween(0, 1000),
            'stripe_customer_id' => $this->faker->uuid(),
            
            'pin' => $this->faker->randomNumber(4, true), // Generate a random 4-digit PIN
        ];
    }
}
