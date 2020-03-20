<?php

namespace App\Interfaces;
use App\Room;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

interface RoomInterface {

    /**
     * @param Integer $property_id
     * @param Request $request
     * @return mixed
     */
    public function create_room(Integer $property_id, Request $request);

    /**
     * @param Integer $property_id
     * @param Integer $room_id
     * @param Request $request
     * @return mixed
     */
    public function update_room(Integer $property_id, Integer $room_id, Request $request);

    /**
     * @param Integer $property_id
     * @param Integer $room_id
     * @return mixed
     */
    public function delete_room(Integer $property_id, Integer $room_id);

    /**
     * @param Integer $property_id
     * @param Integer $room_id
     * @return mixed
     */
    public function get_rooms(Integer $property_id, Integer $room_id);
}
