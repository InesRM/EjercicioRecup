<?php

namespace Database\Seeders;

use App\Models\Atributes;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AtributesUser;
use App\Models\AtributesUsers;

class AtributesUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $atributes = Atributes::all();
        foreach ($users as $user) {
            foreach ($atributes as $atribute) {
                AtributesUsers::factory()->create([
                    'atributeID' => $atribute->ID,
                    'userID' => $user->id,
                    'value' => random_int(1, 5),
                ]);
            }
        }
    }
    }

