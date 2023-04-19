<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rate>
 */
class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Standard=0, Deluxe =1
            'suite_type'=>$this->faker->randomElement([0,1]),
            'stay_type'=>$this->faker->randomElement(['FB','BB']),
            'cost'=>$this->faker->randomElement(['15000,25000,40000']),
        ];
    }
}
