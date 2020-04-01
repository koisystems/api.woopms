<?php

namespace App\Repositories;
use App\Interfaces\RoomRateCalendarInterface;
use App\RoomRateCalendar;
use App\Transformers\RoomRateCalendarTransformer;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

use App\Interfaces\RatePlanInterface;
use App\RatePlan;
use App\Room;
use App\RoomRate;

use League\Fractal;
use League\Fractal\Manager;

class RoomRateCalendarRepository implements  RoomRateCalendarInterface {

    public function create( $property_id, Request $request) {

        /** Is there a better way to do this ? */
        $requestData    =   [
            'property_id'   =>  $property_id,
        ];
        $requestData = array_merge($requestData, $request->only("room_rate_id","room_type_id","rate_plan_id","rate_amount"));

        $fromDate   =    $request->get("from_date");
        $untilDate   =    $request->get("until_date");

        $period = CarbonPeriod::create($fromDate, $untilDate);

        $room_rate_calendar =   [];
        foreach ($period as $date) {
            $requestData['stay_date']   =    $date->format('Y-m-d');

            $roomRateCalendar = RoomRateCalendar::where("property_id",$property_id)
                ->where("room_type_id", $requestData["room_type_id"])
                ->where("rate_plan_id", $requestData['rate_plan_id'])
                ->where("stay_date", $requestData['stay_date'])->first();

            if(empty($roomRateCalendar))
                $roomRateCalendar   =   new RoomRateCalendar;

            $roomRateCalendar->room_type_id     =   $requestData["room_type_id"];
            $roomRateCalendar->rate_plan_id     =   $requestData["rate_plan_id"];
            $roomRateCalendar->stay_date        =   $requestData["stay_date"];
            $roomRateCalendar->property_id      =   $requestData["property_id"];
            $roomRateCalendar->room_rate_id     =   $requestData["room_rate_id"];
            $roomRateCalendar->rate_amount      =   $requestData['rate_amount'];
            $roomRateCalendar->save();

            $room_rate_calendar[]   =   $roomRateCalendar;
        }

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Collection($room_rate_calendar, new RoomRateCalendarTransformer);


        return $fractal->createData($resource)->toArray()['data'];
    }

    public function update($property_id, $id, Request $request) {

        $object = RoomRate::where("id", $id)->where("property_id", $property_id)->firstOrFail();
        $object->update($request->all());

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Item($object, new RoomRateTransformer());
        return $fractal->createData($resource)->toArray()['data'];

    }

    public function get($property_id, $id) {

        if(is_null($id)) {
            $data = RoomRate::where("property_id", $property_id)->get();
        } else {
            $data = RoomRate::where("id", $id)->where("property_id", $property_id)->get();
        }

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Collection($data, new RoomRateTransformer());
        return $fractal->createData($resource)->toArray()['data'];
    }

    public function delete($property_id, $rate_plan_id) {

        $ratePlan = RatePlan::where("id", $rate_plan_id)->where("property_id", $property_id)->firstOrFail();
        return $ratePlan->delete();

    }

}
