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
            'title' => $this->faker->word(),
            'image' => 'products/'. $this->faker->image('public/storage/products', 640, 480, null, false),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement([19, 49, 99])

        ];
    }
}
