<?php

use Illuminate\Database\Seeder;

class ProfileTypesSeeder extends Seeder
{

    public function run()
    {

        $types  =   [
            ['ota_code' => 0 , "name" => "Other (non-OTA). Profile does not match any of the OTA profile types"],
            ['ota_code' => 1 , "name" => "Customer"],
            ['ota_code' => 2 , "name" => "GDS (Global Distribution Service)"],
            ['ota_code' => 3 , "name" => "Corporation"],
            ['ota_code' => 4 , "name" => "Travel agent"],
            ['ota_code' => 5 , "name" => "Wholesaler"],
            ['ota_code' => 6 , "name" => "Group"],
            ['ota_code' => 7 , "name" => "Tour operator"],
            ['ota_code' => 8 , "name" => "CRO"],
            ['ota_code' => 9 , "name" => "Rep Company"],
            ['ota_code' => 10 , "name" => "Internet broker"],
            ['ota_code' => 11 , "name" => "Airline"],
            ['ota_code' => 12 , "name" => "Hotel"],
            ['ota_code' => 13 , "name" => "Car rental"],
            ['ota_code' => 14 , "name" => "Cruise line"],
            ['ota_code' => 15 , "name" => "Employee"],
            ['ota_code' => 16 , "name" => "Event host"],
            ['ota_code' => 17 , "name" => "Supplier partner"],
            ['ota_code' => 18 , "name" => "Billing contact"],
            ['ota_code' => 19 , "name" => "Authorized signature"],
            ['ota_code' => 20 , "name" => "General service contractor"],
            ['ota_code' => 21 , "name" => "Arranger"],
            ['ota_code' => 22 , "name" => "Association"]

        ];

        foreach($types as $type) {
            $t          =   new \App\ProfileType();
            $t->ota_code      =   $type['ota_code'];
            $t->name    =   $type['name'];
            $t->save();
        }

    }
}
