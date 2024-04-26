<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => fake()->unique()->randomNumber(2, true),
            'name' => fake()->words(),
            'description' => fake()->realText(30),
            'price' => fake()->numberBetween(900, 2500),
            'category_id' => fake()->randomNumber(1, 7),
            'regular_holiday'=> fake()->dayOfWeek(),
            'post_code'=> fake()->postcode(),
            'address'=> fake()->address(),
            'phone_number'=> fake()->phoneNumber()
        ];
    }
}
