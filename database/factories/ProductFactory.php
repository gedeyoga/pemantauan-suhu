<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(), 
            'unit' => $this->faker->word(), 
            'stock' => $this->faker->randomDigit(), 
            'expired_date' => $this->faker->dateTimeThisMonth()
        ];
    }
}
