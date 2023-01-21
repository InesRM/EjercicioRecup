<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rol>
 */
class RolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'id' =>fake ()->unique()->numberBetween(1, 3),
            'name' =>fake ()->unique()->randomElement(['god', 'hades', 'human']),
        ];
    }
}
