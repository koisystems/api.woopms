<?php

namespace App\Repositories;
use App\Transformers\PolicyRuleTransformer;
use App\Transformers\RatePlanTransformer;
use Illuminate\Http\Request;

use App\Interfaces\RatePlanInterface;
use App\RatePlan;

use League\Fractal;
use League\Fractal\Manager;

class RatePlanRepository implements  RatePlanInterface {

    public function create_rate_plan( $property_id, Request $request) {

        /** Is there a better way to do this ? */
        $requestData    =   [
            'property_id'   =>  $property_id,
        ];
        $requestData = array_merge($requestData, $request->all());

        $rate_plan = RatePlan::create($requestData);

        $fractal = new Manager();
        $ratePlanRuleResource =  new Fractal\Resource\Item($rate_plan, new RatePlanTransformer);
        return $fractal->createData($ratePlanRuleResource)->toArray()['data'];
    }

    public function update_rate_plan($property_id, $rate_plan_id, Request $request) {

        $rate_plan = RatePlan::where("id", $rate_plan_id)->where("property_id", $property_id)->firstOrFail();
        $rate_plan->update($request->all());

        $fractal = new Manager();
        $ratePlanRuleResource =  new Fractal\Resource\Item($rate_plan, new RatePlanTransformer);
        return $fractal->createData($ratePlanRuleResource)->toArray()['data'];

    }

    public function get_rate_plan($property_id, $rate_plan_id) {

        if(is_null($rate_plan_id)) {
            $rate_plans = RatePlan::where("property_id", $property_id)->get();
        } else {
            $rate_plans = RatePlan::where("id", $rate_plan_id)->where("property_id", $property_id)->get();
        }

        $fractal = new Manager();
        $ratePlanResource =  new Fractal\Resource\Collection($rate_plans, new RatePlanTransformer());
        return $fractal->createData($ratePlanResource)->toArray()['data'];
    }

    public function delete_rate_plan($property_id, $rate_plan_id) {

        $ratePlan = RatePlan::where("id", $rate_plan_id)->where("property_id", $property_id)->firstOrFail();
        return $ratePlan->delete();

    }

}
