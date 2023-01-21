<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            [
                'name' => 'Zeus',
                'email' => 'zeus@dios.com',
                'password' => bcrypt('1234'),
                'role'=> 'god',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Poseidon',
                'email' => 'poseidon@dios.com',
                'password' => bcrypt('1234'),
                'role'=> 'god',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'hades',
                'email' => 'hades@dios.com',
                'password' => bcrypt('1234'),
                'role'=> 'hades',
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);


    }
}
