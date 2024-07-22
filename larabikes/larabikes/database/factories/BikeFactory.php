<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'marca' => $this->faker->randomElement([
                'Honda', 'Kawasaki', 'Ducati', 'Derbi', 'KTM', 'Aprilia',
                'BMW', 'Yamaha', 'Bultaco', 'Suzuki', 'Triumph', 'Kymco'
            ]),
            
            'modelo' => $this->faker->word(),
            'kms' => $this->faker->biasedNumberBetween(0,100000),
            'precio' => $this->faker->randomFloat(2, 1000, 50000),
            'matriculada' => $this->faker->boolean
        ];
    }
}
