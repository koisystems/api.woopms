<?php

namespace App\Interfaces;
use App\Room;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

interface RoomTypeInterface {

    /**
     * @param Integer $property_id
     * @param Request $request
     * @return mixed
     */
    public function create_room_type(Integer $property_id, Request $request);

    /**
     * @param Integer $property_id
     * @param Integer $room_type_id
     * @param Request $request
     * @return mixed
     */
    public function update_room_type(Integer $property_id, Integer $room_type_id, Request $request);

    /**
     * @param Integer $property_id
     * @param Integer $room_type_id
     * @return mixed
     */
    public function delete_room_type(Integer $property_id, Integer $room_type_id);

    /**
     * @param Integer $property_id
     * @param Integer $room_type_id
     * @return mixed
     */
    public function get_room_types(Integer $property_id, Integer $room_type_id);
}
