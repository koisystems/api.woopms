<?php

namespace App\Repositories;
use App\Transformers\PolicyTransformer;
use App\Transformers\RatePlanTransformer;
use Illuminate\Http\Request;

use App\Interfaces\PolicyInterface;
use App\Policy;
use App\PolicyRule;

use League\Fractal;
use League\Fractal\Manager;


class PolicyRepository implements  PolicyInterface {

    public function create_policy( $property_id, Request $request) {

        /** Is there a better way to do this ? */
        $requestData    =   [
            'property_id'   =>  $property_id,
        ];
        $requestData = array_merge($requestData, $request->all());

        $policy =    Policy::create($requestData);

        $this->create_policy_rules( $property_id, $policy, $requestData );

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Item($policy, new PolicyTransformer());
        return $fractal->createData($resource)->toArray()['data'];
    }

    private function create_policy_rules($property_id, $policy, $requestData) {

        if( isset($requestData['rules'])) {
            $rules = $requestData['rules'];
            unset($requestData['rules']);
            foreach ($rules as $rule_type => $ruleCollection) {

                foreach ($ruleCollection as $idx => $rule) {
                    $rule['property_id'] = $property_id;
                    $rule['policy_id'] = $policy->id;
                    PolicyRule::create($rule);
                }
            }
        }
    }

    public function update_policy($property_id, $policy_id, Request $request) {

        $policy = Policy::where("id", $policy_id)->where("property_id", $property_id)->firstOrFail();
        $policy->update($request->all());

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Item($policy, new PolicyTransformer());
        return $fractal->createData($resource)->toArray()['data'];

    }

    public function get_policy($property_id, $policy_id) {

        if(is_null($policy_id)) {
            $policies = Policy::where("property_id", $property_id)->get();
        } else {
            $policies = Policy::where("id", $policy_id)->where("property_id", $property_id)->get();
        }

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Collection($policies, new PolicyTransformer());
        return $fractal->createData($resource)->toArray()['data'];

    }

    public function delete_policy($property_id, $policy_id) {

        $policy = Policy::where("id", $policy_id)->where("property_id", $property_id)->firstOrFail();
        return $policy->delete();

    }

}
