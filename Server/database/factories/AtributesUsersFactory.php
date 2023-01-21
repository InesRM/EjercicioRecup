<?php

namespace Database\Factories;

use App\Models\Atributes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AtributesUsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'userID' => $this->faker->randomElement(User::get('id')),
            'atributeID' => $this->faker->randomElement(Atributes::get('ID')),
            'value' => random_int(1,5)
        ];
    }


}
