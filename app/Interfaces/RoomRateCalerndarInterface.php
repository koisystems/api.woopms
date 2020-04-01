<?php

namespace App\Interfaces;
use App\RoomRate;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

interface RoomRateCalendarInterface {

    /**
     * @param Integer $property_id
     * @param Request $request
     * @return mixed
     */
    public function create(Integer $property_id, Request $request);

    /**
     * @param Integer $property_id
     * @param Integer $room_rate_calendar_id
     * @param Request $request
     * @return mixed
     */
    public function update(Integer $property_id, Integer $room_rate_calendar_id, Request $request);

    /**
     * @param Integer $property_id
     * @param Integer $room_rate_calendar_id
     * @return mixed
     */
    public function delete(Integer $property_id, Integer $room_rate_calendar_id);

    /**
     * @param Integer $property_id
     * @param Integer $room_rate_calendar_id
     * @return mixed
     */
    public function get(Integer $property_id, Integer $room_rate_calendar_id);
}
