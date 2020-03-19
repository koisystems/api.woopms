<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use  App\User;
use  App\RatePlan;


class RatePlanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a new RatePlan
     * @param $property_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create($property_id, Request $request) {

        try {
            $this->validate($request, [
                'code' => 'required',
                'title' => 'required',
            ]);
        } catch( Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Rate Plan Creation Failed!'], 409);

        }

        /** Is there a better way to do this ? */
        $requestData    =   [
            'property_id'   =>  $property_id,
        ];
        $requestData = array_merge($requestData, $request->all());


        $room = RatePlan::create($requestData);
        return response()->json(['rate_plan' => $room, 'message' => 'CREATED'], 201);


    }

    /**
     * Update an existing rate plan
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
                'title' => 'required',
            ]);
        } catch( Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'RatePlan Update Failed!'], 409);

        }

        $rate_plan = RatePlan::where("id", $id)->where("property_id", $property_id)->firstOrFail();
        $rate_plan->update($request->all());

        return response()->json(['rate_plan' => $rate_plan, 'message' => 'UPDATED'], 201);

    }

    /**
     * Get a single or a list of rate plan
     * @param $property_id
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($property_id, $id = null) {

        if(is_null($id)) {
            $rate_plans = RatePlan::where("property_id", $property_id)->get();
        } else {
            $rate_plans = RatePlan::where("id", $id)->where("property_id", $property_id)->get();
        }
        return response()->json(['rate_plans' => $rate_plans->toArray(), 'message' => 'GET'], 201);

    }

    /**
     * Delete a single rate plan
     * @param $property_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($property_id, $id) {

        try {
            $rate_plan = RatePlan::where("id", $id)->where("property_id", $property_id)->firstOrFail();
            if ($rate_plan->delete())
                return response()->json(['message' => 'DELETED'], 201);
        } catch( ModelNotFoundException $e) {
            // empty on purpose
        }
        return response()->json(['message' => 'Rate plan delete Failed!'], 409);

    }

}
