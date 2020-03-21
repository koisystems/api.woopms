<?php

use Illuminate\Database\Seeder;
use App\BookingChannelType;
use App\BookingChannel;

class BookingChannelsSeeder extends Seeder
{

    public function run()
    {

        $channel_types  =   [
            ['id' => 1 , "name" => "Global distribution system (GDS)"],
            ['id' => 2,  "name" => "Alternative distribution system (ADS)"],
            ['id' => 3 , "name"=> "Sales and catering system (SCS)"],
            ['id' => 4 , "name"=> "Property management system (PMS)"],
            ['id' => 5 , "name"=> "Central reservation system (CRS)"],
            ['id' => 6 , "name"=> "Tour operator system (TOS)"],
            ['id' => 7 , "name"=> "Internet"],
            ['id' => 8 , "name"=> "Kiosk"],
            ['id' => 9 , "name"=> "Agent"],
        ];

        $channels   =   [
            ['name'   =>    'Booking.com', 'code' => 'BDC', 'is_active' => 1, 'booking_channel_type_id' => 7],
            ['name'   =>    'Expedia',   'code' => 'EXP' , 'is_active' => 1, 'booking_channel_type_id' => 7],
            ['name'   =>    'Walk-in',   'code'  => 'WALK', 'is_active' => 1, 'booking_channel_type_id' => 2],
        ];

        foreach($channel_types as $channelType) {
            $bct = new BookingChannelType();
            $bct->id            =   $channelType['id'];
            $bct->name          =   $channelType['name'];
            $bct->save();
        }

        foreach($channels as $channel) {
            $bc         =   new BookingChannel();
            $bc->name   =   $channel['name'];
            $bc->code   =   $channel['code'];
            $bc->is_active = $channel['is_active'];
            $bc->booking_channel_type_id = $channel['booking_channel_type_id'];
            $bc->save();
        }

    }
}
