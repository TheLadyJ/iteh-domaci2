<?php

namespace Database\Factories;

use App\Models\Kategorija;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReceptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'naziv_recepta'=>$this->faker->word(),
            'opis_recepta'=>$this->faker->sentence(),
            'kategorija_id' => Kategorija::factory(),
            'user_id' => User::factory(),
        ];
    }
}
