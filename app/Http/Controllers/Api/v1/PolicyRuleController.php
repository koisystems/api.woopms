<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use  App\Policy;
use  App\PolicyRule;
use App\Interfaces\PolicyRuleInterface;

class PolicyRuleController extends Controller
{
    private $policyRuleRepository;
    public function __construct(PolicyRuleInterface $policyRuleRepository)
    {
        $this->middleware('auth');
        $this->policyRuleRepository =   $policyRuleRepository;
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

        $policy_rule    =   $this->policyRuleRepository->create_policy_rule($property_id, $policy_id, $request);

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

        $policy_rule    =   $this->policyRuleRepository->update_policy_rule($property_id, $policy_id, $id, $request);

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

        $policy_rules   =   $this->policyRuleRepository->get_policy_rule($property_id, $policy_id, $id);

        return response()->json(['policy_rules' => $policy_rules, 'message' => 'GET'], 201);

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
            $this->policyRuleRepository->delete_policy_rule($property_id, $policy_id, $id);
                return response()->json(['message' => 'DELETED'], 201);
        } catch( ModelNotFoundException $e) {
            // empty on purpose
        }
        return response()->json(['message' => 'Policy Rule delete Failed!'], 409);

    }

}
