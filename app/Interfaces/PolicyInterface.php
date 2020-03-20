<?php

namespace App\Interfaces;
use App\Policy;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

interface PolicyInterface {

    /**
     * @param Integer $property_id
     * @param Request $request
     * @return mixed
     */
    public function create_policy(Integer $property_id, Request $request);

    /**
     * @param Integer $property_id
     * @param Integer $policy_id
     * @param Request $request
     * @return mixed
     */
    public function update_policy(Integer $property_id, Integer $policy_id, Request $request);

    /**
     * @param Integer $property_id
     * @param Integer $policy_id
     * @return mixed
     */
    public function delete_policy(Integer $property_id, Integer $policy_id);

    /**
     * @param Integer $property_id
     * @param Integer $policy_id
     * @return mixed
     */
    public function get_policy(Integer $property_id, Integer $policy_id);
}
