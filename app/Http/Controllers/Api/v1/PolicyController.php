<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Interfaces\PolicyInterface;

use  App\Policy;


class PolicyController extends Controller
{
    private $policyRepository;

    public function __construct(PolicyInterface $policyRepository)
    {
        $this->policyRepository = $policyRepository;
    }

    /**
     * Create a new Policy
     * @param $property_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create($property_id, Request $request) {

        try {
            $this->validate($request, [
                'code' => 'required',
                'has_guarantee' => 'required',
                'has_deposit' => 'required',
                'has_cancellation_penalty' => 'required',
                'has_modification_penalty' => 'required',
            ]);
        } catch( Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Policy Creation Failed!'], 409);

        }

        $policy = $this->policyRepository->create_policy($property_id, $request);

        return response()->json(['data' => $policy, 'message' => 'CREATED'], 201);


    }

    /**
     * Update an existing policy
     * @param $property_id
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($property_id, $id, Request $request) {

        try {
            $this->validate($request, [
                'code' => 'required',
                'has_guarantee' => 'required',
                'has_deposit' => 'required',
                'has_cancellation_penalty' => 'required',
                'has_modification_penalty' => 'required',
            ]);
        } catch( Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Policy Failed!'], 409);

        }

        $policy = $this->policyRepository->update_policy($property_id, $id, $request);

        return response()->json(['data' => $policy, 'message' => 'UPDATED'], 201);

    }

    /**
     * Get a single or a list of policies
     * @param $property_id
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($property_id, $id = null) {

        $policies = $this->policyRepository->get_policy($property_id, $id);

        return response()->json(['data' => $policies, 'message' => 'GET'], 201);

    }

    /**
     * Delete a single policy
     * @param $property_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($property_id, $id) {

        try {

            if( $this->policyRepository->delete_policy($property_id, $id) )
                return response()->json(['message' => 'DELETED'], 201);
        } catch( ModelNotFoundException $e) {
            // empty on purpose
        }

        return response()->json(['message' => 'Policy delete Failed!'], 409);

    }

}
