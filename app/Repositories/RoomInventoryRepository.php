<?php

namespace App\Repositories;
use App\Transformers\RoomInventoryTransformer;
use Illuminate\Http\Request;

use App\Interfaces\RoomInventoryInterface;
use App\RoomInventory;

use League\Fractal;
use League\Fractal\Manager;


class RoomInventoryRepository implements  RoomInventoryInterface {

    public function create_room_inventory( $property_id, Request $request) {


        /** Is there a better way to do this ? */
        $requestData    =   [
            'property_id'   =>  $property_id,
        ];
        $requestData = array_merge($requestData, $request->all());


        $roomInventory = RoomInventory::create($requestData);

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Item($roomInventory, new RoomInventoryTransformer());
        return $fractal->createData($resource)->toArray()['data'];
    }

    public function update_room_inventory($property_id, $room_inventory_id, Request $request) {

        $roomInventory = RoomInventory::where("id", $room_inventory_id)->where("property_id", $property_id)->firstOrFail();
        $roomInventory->update($request->all());

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Item($roomInventory, new RoomInventoryTransformer());
        return $fractal->createData($resource)->toArray()['data'];

    }

    public function delete_room_inventory($property_id, $room_inventory_id) {

        $roomInventory = RoomInventory::where("id", $room_inventory_id)->where("property_id", $property_id)->firstOrFail();
        return $roomInventory->delete();

    }

    public function get_room__inventories($property_id, $room_inventory_id) {

        if(is_null($room_inventory_id)) {
            $roomInventories = RoomInventory::where("property_id", $property_id)->get();
        } else {
            $roomInventories = RoomInventory::with("rooms")->where("id", $room_inventory_id)->where("property_id", $property_id)->get();
        }

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Collection($roomInventories, new RoomInventoryTransformer());
        return $fractal->createData($resource)->toArray()['data'];

    }

}
