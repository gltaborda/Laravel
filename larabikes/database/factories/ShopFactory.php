<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shop::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word(),
            'poblacion' => $this->faker->randomElement([
                'Terrassa', 'Cerdanyola del Vallès' , 'Barberà del Vallès', 'Sabadell',
                'Les Fonts', 'Rubí', 'Sant Cugat del Vallès', 'Sant Quirze del Vallès'
            ]),
            'telefono' => $this->faker->biasedNumberBetween(9300000000,9399999999),
        ];
    }
}
