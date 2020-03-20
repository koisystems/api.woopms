<?php

namespace App\Interfaces;
use App\RatePlan;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

interface RatePlanInterface {


    public function create_rate_plan(Integer $property_id, Request $request);


    public function update_rate_plan(Integer $property_id, Integer $rate_plan_id, Request $request);


    public function delete_rate_plan(Integer $property_id, Integer $rate_plan_id);


    public function get_rate_plan(Integer $property_id, Integer $rate_plan_id);
}
