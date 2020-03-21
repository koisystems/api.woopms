<?php

use Illuminate\Database\Seeder;
use App\FeeTaxType;

class FeeTaxTypesSeeder extends Seeder
{

    public function run()
    {

        $types  =   [
            ['ota_code' => 1 , "name" => "Bed tax"],
            ['ota_code' => 2 , "name" => "City hotel fee"],
            ['ota_code' => 3 , "name" => "City tax"],
            ['ota_code' => 4 , "name" => "County tax"],
            ['ota_code' => 5 , "name" => "Energy tax"],
            ['ota_code' => 6 , "name" => "Federal tax"],
            ['ota_code' => 7 , "name" => "Food  and  beverage tax"],
            ['ota_code' => 8 , "name" => "Lodging tax"],
            ['ota_code' => 9 , "name" => "Maintenance tax"],
            ['ota_code' => 10 , "name" => "Occupancy tax"],
            ['ota_code' => 11 , "name" => "Package fee"],
            ['ota_code' => 12 , "name" => "Resort fee"],
            ['ota_code' => 13 , "name" => "Sales tax"],
            ['ota_code' => 14 , "name" => "Service charge"],
            ['ota_code' => 15 , "name" => "State tax"],
            ['ota_code' => 16 , "name" => "Surcharge"],
            ['ota_code' => 17 , "name" => "Total tax"],
            ['ota_code' => 18 , "name" => "Tourism tax"],
            ['ota_code' => 19 , "name" => "VAT/GST tax"],
            ['ota_code' => 20 , "name" => "Surplus Lines tax"],
            ['ota_code' => 21 , "name" => "Insurance Premium tax"],
            ['ota_code' => 22 , "name" => "Application Fee"],
            ['ota_code' => 23 , "name" => "Express Handling Fee"],
            ['ota_code' => 24 , "name" => "Exempt"],
            ['ota_code' => 25 , "name" => "Standard"],
            ['ota_code' => 26 , "name" => "Zero-rated"],
            ['ota_code' => 27 , "name" => "Miscellaneous"],
            ['ota_code' => 28 , "name" => "Room Tax"],
            ['ota_code' => 29 , "name" => "Early checkout fee"],
            ['ota_code' => 30 , "name" => "Country tax"],
            ['ota_code' => 31 , "name" => "Extra person charge"],
            ['ota_code' => 32 , "name" => "Banquet service fee"],
            ['ota_code' => 33 , "name" => "Room service fee"],
            ['ota_code' => 34 , "name" => "Local fee"],
            ['ota_code' => 35 , "name" => "Goods and services tax (GST)"],
            ['ota_code' => 36 , "name" => "Value Added Tax (VAT)"],
            ['ota_code' => 37 , "name" => "Crib fee"],
            ['ota_code' => 38 , "name" => "Rollaway fee"],
            ['ota_code' => 39 , "name" => "Assessment/license tax"],
            ['ota_code' => 40 , "name" => "Pet santitation fee"],
            ['ota_code' => 41 , "name" => "Not known"],

        ];

        foreach($types as $type) {
            $t          =   new FeeTaxType();
            $t->ota_code      =   $type['ota_code'];
            $t->name    =   $type['name'];
            $t->save();
        }

    }
}
