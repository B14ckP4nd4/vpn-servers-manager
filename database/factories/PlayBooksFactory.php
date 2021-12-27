<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlayBooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return array(
            'name' => 'playbook_'.$this->faker->regexify('[A-Za-z0-9]{5}'),
            'path' => storage_path('playbooks/'.$this->faker->regexify('[A-Za-z0-9]{5}')),
            'url' => 'https://github.com/B14ckP4nd4/playbooks'.$this->faker->regexify('[A-Za-z0-9]{5}'),
            'last_updated_at' => $this->faker->dateTime,
        );
    }
}
