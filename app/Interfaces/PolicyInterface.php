<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface PolicyInterface {
    public function create_policy($property_id, Request $request);
    public function update_policy($property_id, $policy_id, Request $request);
    public function delete_policy($property_id, $policy_id);
    public function get_policy($property_id, $policy_id);
}
