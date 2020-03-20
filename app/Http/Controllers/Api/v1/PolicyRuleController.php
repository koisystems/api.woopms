<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use  App\Policy;
use  App\PolicyRule;


class PolicyRuleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a new Policy Rule
     * @param $property_id
     * @param $policy_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create($property_id, $policy_id, Request $request) {

        try {
            $this->validate($request, [
                'type'              =>  'required',
                'hours_before'      => 'required',
                'charge_based_on'   => 'required',
                'amount'            => 'required',
            ]);
        } catch( Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Policy Rule Creation Failed!'], 409);

        }

        /** Is there a better way to do this ? */
        $requestData    =   [
            'property_id'   =>  $property_id,
            'policy_id'     =>  $policy_id
        ];
        $requestData = array_merge($requestData, $request->all());


        $policy_rule = PolicyRule::create($requestData);
        return response()->json(['policy_rule' => $policy_rule, 'message' => 'CREATED'], 201);


    }

    /**
     * Update an existing policy id
     * @param $property_id
     * @param $policy_id
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($property_id, $policy_id, $id, Request $request) {

        try {
            $this->validate($request, [
                'type'              => 'required',
                'hours_before'      => 'required',
                'charge_based_on'   => 'required',
                'amount'            => 'required',
            ]);
        } catch( Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Policy Rule Failed!'], 409);

        }

        $policy_rule = PolicyRule::where("id", $id)->where("property_id", $property_id)->where("policy_id", $policy_id)->where("id", $id)->firstOrFail();
        $policy_rule->update($request->all());

        return response()->json(['policy_rule' => $policy_rule, 'message' => 'UPDATED'], 201);

    }

    /**
     * Get a single policy rule or a policy rules list
     * @param $property_id
     * @param $policy_id
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($property_id, $policy_id, $id = null) {

        if(is_null($id)) {
            $policy_rules = PolicyRule::where("property_id", $property_id)->where("policy_id", $policy_id)->get();
        } else {
            $policy_rules = PolicyRule::where("id", $id)->where("property_id", $property_id)->where("policy_id", $policy_id)->get();
        }
        return response()->json(['policy_rules' => $policy_rules->toArray(), 'message' => 'GET'], 201);

    }

    /**
     * Delete an existing policy rule
     * @param $property_id
     * @param $policy_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($property_id, $policy_id, $id) {

        try {
            $policy_rule = PolicyRule::where("id", $id)->where("property_id", $property_id)->where("policy_id", $policy_id)->firstOrFail();
            if ($policy_rule->delete())
                return response()->json(['message' => 'DELETED'], 201);
        } catch( ModelNotFoundException $e) {
            // empty on purpose
        }
        return response()->json(['message' => 'Policy Rule delete Failed!'], 409);

    }

}
