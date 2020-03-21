<?php

use Illuminate\Database\Seeder;
use App\FeeTaxType;

class FeeTaxTypesSeeder extends Seeder
{

    public function run()
    {

        $types  =   [
            ['id' => 1 , "name" => "Bed tax"],
            ['id' => 2 , "name" => "City hotel fee"],
            ['id' => 3 , "name" => "City tax"],
            ['id' => 4 , "name" => "County tax"],
            ['id' => 5 , "name" => "Energy tax"],
            ['id' => 6 , "name" => "Federal tax"],
            ['id' => 7 , "name" => "Food  and  beverage tax"],
            ['id' => 8 , "name" => "Lodging tax"],
            ['id' => 9 , "name" => "Maintenance tax"],
            ['id' => 10 , "name" => "Occupancy tax"],
            ['id' => 11 , "name" => "Package fee"],
            ['id' => 12 , "name" => "Resort fee"],
            ['id' => 13 , "name" => "Sales tax"],
            ['id' => 14 , "name" => "Service charge"],
            ['id' => 15 , "name" => "State tax"],
            ['id' => 16 , "name" => "Surcharge"],
            ['id' => 17 , "name" => "Total tax"],
            ['id' => 18 , "name" => "Tourism tax"],
            ['id' => 19 , "name" => "VAT/GST tax"],
            ['id' => 20 , "name" => "Surplus Lines tax"],
            ['id' => 21 , "name" => "Insurance Premium tax"],
            ['id' => 22 , "name" => "Application Fee"],
            ['id' => 23 , "name" => "Express Handling Fee"],
            ['id' => 24 , "name" => "Exempt"],
            ['id' => 25 , "name" => "Standard"],
            ['id' => 26 , "name" => "Zero-rated"],
            ['id' => 27 , "name" => "Miscellaneous"],
            ['id' => 28 , "name" => "Room Tax"],
            ['id' => 29 , "name" => "Early checkout fee"],
            ['id' => 30 , "name" => "Country tax"],
            ['id' => 31 , "name" => "Extra person charge"],
            ['id' => 32 , "name" => "Banquet service fee"],
            ['id' => 33 , "name" => "Room service fee"],
            ['id' => 34 , "name" => "Local fee"],
            ['id' => 35 , "name" => "Goods and services tax (GST)"],
            ['id' => 36 , "name" => "Value Added Tax (VAT)"],
            ['id' => 37 , "name" => "Crib fee"],
            ['id' => 38 , "name" => "Rollaway fee"],
            ['id' => 39 , "name" => "Assessment/license tax"],
            ['id' => 40 , "name" => "Pet santitation fee"],
            ['id' => 41 , "name" => "Not known"],

        ];

        foreach($types as $type) {
            $t          =   new FeeTaxType();
            $t->id      =   $type['id'];
            $t->name    =   $type['name'];
            $t->save();
        }

    }
}
