<?php

namespace App\Repositories;
use App\Transformers\RoomTypeTransformer;
use Illuminate\Http\Request;

use App\Interfaces\RoomTypeInterface;
use App\RoomType;

use League\Fractal;
use League\Fractal\Manager;


class RoomTypeRepository implements  RoomTypeInterface {

    public function create_room_type( $property_id, Request $request) {


        /** Is there a better way to do this ? */
        $requestData    =   [
            'property_id'   =>  $property_id,
        ];
        $requestData = array_merge($requestData, $request->all());


        $roomType = RoomType::create($requestData);

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Item($roomType, new RoomTypeTransformer());
        return $fractal->createData($resource)->toArray()['data'];
    }

    public function update_room_type($property_id, $room_inventory_id, Request $request) {

        $roomType = RoomType::where("id", $room_inventory_id)->where("property_id", $property_id)->firstOrFail();
        $roomType->update($request->all());

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Item($roomType, new RoomTypeTransformer());
        return $fractal->createData($resource)->toArray()['data'];

    }

    public function delete_room_type($property_id, $room_inventory_id) {

        $roomType = RoomType::where("id", $room_inventory_id)->where("property_id", $property_id)->firstOrFail();
        return $roomType->delete();

    }

    public function get_room_types($property_id, $room_type_id) {

        if(is_null($room_type_id)) {
            $roomTypes = RoomType::where("property_id", $property_id)->get();
        } else {
            $roomTypes = RoomType::with("rooms")->where("id", $room_type_id)->where("property_id", $property_id)->get();
        }

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Collection($roomTypes, new RoomTypeTransformer());
        return $fractal->createData($resource)->toArray()['data'];

    }

}
