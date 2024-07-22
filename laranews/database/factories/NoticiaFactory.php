<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NoticiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(),
            'tema' => $this->faker->randomElement([
                'Deporte', 'Política', 'Economía', 'Arte', 'Salud',
                'Cultura', 'Viajes', 'Tecnología','Internacional'
            ]),
            'texto' => $this->faker->paragraph(),
            'imagen' => 'messi'.$this->faker->numberBetween(1,10).'.jpg',
            'user_id' => $this->faker->numberBetween(1,10)
        ];
    }
}
