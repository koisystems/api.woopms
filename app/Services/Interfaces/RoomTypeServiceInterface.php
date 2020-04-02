<?php

namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface RoomTypeServiceInterface {

    /**
     * @param Integer $property_id
     * @param Request $request
     * @return mixed
     */
    public function create_room_type(int $property_id, Request $request);

    /**
     * @param Integer $property_id
     * @param Integer $room_type_id
     * @param Request $request
     * @return mixed
     */
    public function update_room_type(int $property_id, int $room_type_id, Request $request);

    /**
     * @param Integer $property_id
     * @param Integer $room_type_id
     * @return mixed
     */
    public function delete_room_type(int $property_id, int $room_type_id);

    /**
     * @param Integer $property_id
     * @param Integer $room_type_id
     * @return mixed
     */
    public function get_room_types(int $property_id, int $room_type_id);
}
