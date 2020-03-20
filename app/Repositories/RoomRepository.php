<?php

namespace App\Repositories;
use Illuminate\Http\Request;

use App\Interfaces\RoomInterface;
use App\Transformers\RoomTransformer;
use App\Room;

use League\Fractal;
use League\Fractal\Manager;


class RoomRepository implements  RoomInterface {

    public function create_room( $property_id, Request $request) {

        /** Is there a better way to do this ? */
        $requestData    =   [
            'property_id'   =>  $property_id,
        ];
        $requestData = array_merge($requestData, $request->all());


        $room = Room::create($requestData);

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Item($room, new RoomTransformer());
        return $fractal->createData($resource)->toArray()['data'];
    }

    public function update_room($property_id, $room_id, Request $request) {

        $room = Room::where("id", $room_id)->where("property_id", $property_id)->firstOrFail();
        $room->update($request->all());

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Item($room, new RoomTransformer());
        return $fractal->createData($resource)->toArray()['data'];

    }

    public function get_rooms($property_id, $room_id) {


        if(is_null($room_id)) {
            $rooms = Room::where("property_id", $property_id)->get();
        } else {
            $rooms = Room::where("id", $room_id)->where("property_id", $property_id)->get();
        }

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Collection($rooms, new RoomTransformer());
        return $fractal->createData($resource)->toArray()['data'];

    }

    public function delete_room($property_id, $room_id) {

        $room = Room::where("id", $room_id)->where("property_id", $property_id)->firstOrFail();
        return $room->delete();

    }

}
