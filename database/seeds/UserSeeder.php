<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,1) as $index) {
            DB::table('users')->insert([
                'id'    =>  $index,
                'name' => "Jose Silva",
                'email' => "jose@koisys.com",
                'password' => Hash::make("12345"),

            ]);

        };
    }
}
