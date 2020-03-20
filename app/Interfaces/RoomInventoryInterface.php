<?php

namespace App\Interfaces;
use App\Room;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

interface RoomInventoryInterface {

    /**
     * @param Integer $property_id
     * @param Request $request
     * @return mixed
     */
    public function create_room_inventory(Integer $property_id, Request $request);

    /**
     * @param Integer $property_id
     * @param Integer $room_inventory_id
     * @param Request $request
     * @return mixed
     */
    public function update_room_inventory(Integer $property_id, Integer $room_inventory_id, Request $request);

    /**
     * @param Integer $property_id
     * @param Integer $room_inventory_id
     * @return mixed
     */
    public function delete_room_inventory(Integer $property_id, Integer $room_inventory_id);

    /**
     * @param Integer $property_id
     * @param Integer $room_inventory_id
     * @return mixed
     */
    public function get_room__inventories(Integer $property_id, Integer $room_inventory_id);
}
