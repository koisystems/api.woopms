<?php

namespace App\Interfaces;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

interface PolicyRuleInterface {

    /**
     * @param Integer $property_id
     * @param Integer $policy_id
     * @param Request $request
     * @return mixed
     */
    public function create_policy_rule(Integer $property_id, Integer $policy_id, Request $request);

    /**
     * @param Integer $property_id
     * @param Integer $policy_id
     * @param Integer $policy_rule_id
     * @param Request $request
     * @return mixed
     */
    public function update_policy_rule(Integer $property_id, Integer $policy_id, Integer $policy_rule_id, Request $request);

    /**
     * @param Integer $property_id
     * @param Integer $policy_id
     * @param Integer $policy_rule_id
     * @return mixed
     */
    public function delete_policy_rule(Integer $property_id, Integer $policy_id, Integer $policy_rule_id);

    /**
     * @param Integer $property_id
     * @param Integer $policy_id
     * @param Integer $policy_rule_id
     * @return mixed
     */
    public function get_policy_rule(Integer $property_id, Integer $policy_id, Integer $policy_rule_id);
}
