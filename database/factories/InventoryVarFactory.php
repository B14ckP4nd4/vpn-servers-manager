<?php


namespace Database\Factories;


use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryVarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => "var_" . $this->faker->regexify('[A-Za-z0-9]{10}'),
            'val' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'inventory_id' => $this->getRandomInventoryID(),
        ];
    }

    protected function getRandomInventoryID(){
        return Inventory::inRandomOrder()->limit(1)->first()->id;
    }

}
