<?php

namespace App\Repositories;


use App\Interfaces\RoomTypeInterface;
use App\RoomType;


class RoomTypeRepository implements  RoomTypeInterface {

    public function create( $params ) {
        return RoomType::create( $params );
    }

    public function update($property_id, $room_inventory_id, $params) {

        $roomType = RoomType::where("id", $room_inventory_id)->where("property_id", $property_id)->firstOrFail();
        $roomType->update($params);
        return $roomType;
    }

    public function delete($property_id, $room_inventory_id) {

        $roomType = RoomType::where("id", $room_inventory_id)->where("property_id", $property_id)->firstOrFail();
        return $roomType->delete();

    }

    public function get($property_id, $room_type_id) {

        if(is_null($room_type_id)) {
            $roomTypes = RoomType::where("property_id", $property_id)->get();
        } else {
            $roomTypes = RoomType::where("id", $room_type_id)->where("property_id", $property_id)->get();
        }

        return $roomTypes;

    }

}
