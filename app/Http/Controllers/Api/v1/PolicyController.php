<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use  App\Policy;


class PolicyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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

        /** Is there a better way to do this ? */
        $requestData    =   [
            'property_id'   =>  $property_id,
        ];
        $requestData = array_merge($requestData, $request->all());


        $policy = Policy::create($requestData);
        return response()->json(['policy' => $policy, 'message' => 'CREATED'], 201);


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

        $policy = Policy::where("id", $id)->where("property_id", $property_id)->firstOrFail();
        $policy->update($request->all());

        return response()->json(['policy' => $policy, 'message' => 'UPDATED'], 201);

    }

    /**
     * Get a single or a list of policies
     * @param $property_id
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($property_id, $id = null) {

        if(is_null($id)) {
            $policies = Policy::where("property_id", $property_id)->get();
        } else {
            $policies = Policy::where("id", $id)->where("property_id", $property_id)->get();
        }
        return response()->json(['policies' => $policies->toArray(), 'message' => 'GET'], 201);

    }

    /**
     * Delete a single policy
     * @param $property_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($property_id, $id) {

        try {
            $policy = Policy::where("id", $id)->where("property_id", $property_id)->firstOrFail();
            if ($policy->delete())
                return response()->json(['message' => 'DELETED'], 201);
        } catch( ModelNotFoundException $e) {
            // empty on purpose
        }
        return response()->json(['message' => 'Policy delete Failed!'], 409);

    }

}
