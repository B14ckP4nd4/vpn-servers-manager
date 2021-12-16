<?php

namespace Database\Factories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'inventory_id' => $this->getRandomInventoryID(),
            'server' => $this->faker->ipv4,
        ];
    }

    protected function getRandomInventoryID(){
        return Inventory::inRandomOrder()->limit(1)->first()->id;
    }
}
