<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoomInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $room_id = 0;
        foreach (range(1,4) as $index) {
            $room_inventory_id  = DB::table('room_inventories')->insertGetId([
                    'property_id' => 1,
                    'code' => strtoupper($faker->word),
                    'title' => $faker->name,
                    'description' => implode(" ",$faker->words(6)),
                ]);

            foreach (range(1,20) as $idx) {
                $room_id++;
                DB::table('rooms')->insertGetId([
                    'property_id' => 1,
                    'room_inventory_id' => $room_inventory_id,
                    'code' => "ROOM".$room_id,
                    'title' => "Room ".$room_id." ({$room_inventory_id})",
                    'description' => implode(" ",$faker->words(2)),
                ]);

            };

            };
    }
}
