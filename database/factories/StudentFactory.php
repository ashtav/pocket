<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition()
    {
        return [
            'nis' => rand(10000, 99999),
            'name' => $this->faker->name,
            'phone' => rand(1000000000, 9999900000),
            'address' => $this->faker->text,
            'class' => '5M',
        ];
    }
}
