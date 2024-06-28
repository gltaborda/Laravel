<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InstrumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'categoria' => $this->faker->randomElement([
                'Guitarra', 'Violín', 'Teclado', 'Piano', 'Bajo', 'Batería',
                'Flauta', 'Saxo', 'Trompeta', 'Triángulo', 'Ukelele', 'Arpa'
            ]),
            'marca' => $this->faker->randomElement([
                'Fender', 'Squier', 'Gibson', 'Epiphone', 'Yamaha', 'Tama',
                'Ibanez', 'Stradivarius', 'Jupiter', 'Ludwig', 'Korg', 'Venus'
            ]),
            
            'modelo' => $this->faker->word(),
            'anio' => $this->faker->numberBetween(2000,2024),
            'precio' => $this->faker->randomFloat(0, 300, 50000),
            'usado' => $this->faker->boolean
            //
        ];
    }
}
