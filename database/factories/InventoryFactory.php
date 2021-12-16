<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => "inventory_" . $this->faker->regexify('[A-Za-z0-9]{10}'),
            'is_active' => $this->faker->boolean(50),
            'last_refresh' => ( $this->faker->boolean(50) ) ? $this->faker->dateTime('now') : null,
        ];
    }
}
