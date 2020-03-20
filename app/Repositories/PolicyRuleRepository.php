<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use League\Fractal;
use League\Fractal\Manager;
use App\Transformers\PolicyRuleTransformer;

use App\Interfaces\PolicyRuleInterface;
use App\PolicyRule;

class PolicyRuleRepository implements  PolicyRuleInterface {

    public function create_policy_rule($property_id, $policy_id, Request $request) {

        /** Is there a better way to do this ? */
        $requestData    =   [
            'property_id'   =>  $property_id,
            'policy_id'     =>  $policy_id
        ];
        $requestData = array_merge($requestData, $request->all());
        $policyRule =   PolicyRule::create($requestData);

        $fractal = new Manager();
        $policyRuleResource =  new Fractal\Resource\Item($policyRule, new PolicyRuleTransformer);
        return $fractal->createData($policyRuleResource)->toArray()['data'];
    }

    public function update_policy_rule($property_id, $policy_id, $policy_rule_id, Request $request) {

        $policy_rule = PolicyRule::where("id", $policy_rule_id)->where("property_id", $property_id)->where("policy_id", $policy_id)->firstOrFail();
        $policy_rule->update($request->all());

        $fractal = new Manager();
        $policyRuleResource =  new Fractal\Resource\Item($policy_rule, new PolicyRuleTransformer);
        return $fractal->createData($policyRuleResource)->toArray()['data'];

    }

    public function get_policy_rule($property_id, $policy_id, $policy_rule_id) {

        if(is_null($policy_rule_id)) {
            $policy_rules = PolicyRule::where("property_id", $property_id)->where("policy_id", $policy_id)->get();
        } else {
            $policy_rules = PolicyRule::where("id", $policy_rule_id)->where("property_id", $property_id)->where("policy_id", $policy_id)->get();
        }

        $fractal = new Manager();
        $policyRuleResource =  new Fractal\Resource\Collection($policy_rules, new PolicyRuleTransformer);
        return $fractal->createData($policyRuleResource)->toArray()['data'];

    }

    public function delete_policy_rule($property_id, $policy_id, $policy_rule_id) {
        $policy_rule = PolicyRule::where("id", $policy_rule_id)->where("property_id", $property_id)->where("policy_id", $policy_id)->firstOrFail();
        return $policy_rule->delete();
    }

}
