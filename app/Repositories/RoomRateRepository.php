<?php

namespace App\Repositories;
use App\Interfaces\RoomRateInterface;
use App\Transformers\PolicyRuleTransformer;
use App\Transformers\RoomRateTransformer;
use Illuminate\Http\Request;

use App\Interfaces\RatePlanInterface;
use App\RatePlan;
use App\Room;
use App\RoomRate;

use League\Fractal;
use League\Fractal\Manager;

class RoomRateRepository implements  RoomRateInterface {

    public function create( $property_id, Request $request) {

        /** Is there a better way to do this ? */
        $requestData    =   [
            'property_id'   =>  $property_id,
        ];
        $requestData = array_merge($requestData, $request->all());

        $ratePlanIdCollection   =   (array)$requestData['rate_plan_id'];

        $room_rate  =   [];
        unset($requestData['rate_plan_id']);
        foreach($ratePlanIdCollection as $ratePlanId) {
            $requestData['rate_plan_id']    =   $ratePlanId;
            $room_rate[] = RoomRate::create($requestData);
            unset($requestData['rate_plan_id']);
        }

        $fractal = new Manager();
        if( count($room_rate) > 0) {
            $resource =  new Fractal\Resource\Collection($room_rate, new RoomRateTransformer);
        } else {
            $resource =  new Fractal\Resource\Item($room_rate, new RoomRateTransformer);

        }
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
