<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PropertySeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,2) as $index) {
            DB::table('properties')->insert([
                'id'    =>  $index,
                'name' => $faker->name,
                'vat_number' => $faker->randomNumber(9),
                'address' => $faker->address,
                'city'  => $faker->city,
                'country'   => $faker->country
            ]);

        };
    }
}
