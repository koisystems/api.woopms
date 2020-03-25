<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Interfaces\RatePlanInterface;

use  App\User;
use  App\RatePlan;


class RatePlanController extends Controller
{
    private $ratePlanRepository;

    public function __construct(RatePlanInterface $ratePlanRepository)
    {
        $this->middleware('auth');
        $this->ratePlanRepository  =   $ratePlanRepository;
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

        $rate_plan  =   $this->ratePlanRepository->create_rate_plan($property_id, $request);

        return response()->json(['data' => $rate_plan, 'message' => 'CREATED'], 201);


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

        $rate_plan  =   $this->ratePlanRepository->update_rate_plan($property_id, $id, $request);

        return response()->json(['data' => $rate_plan, 'message' => 'UPDATED'], 201);

    }

    /**
     * Get a single or a list of rate plan
     * @param $property_id
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($property_id, $id = null) {

        $rate_plans = $this->ratePlanRepository->get_rate_plan($property_id, $id);

        return response()->json(['data' => $rate_plans, 'message' => 'GET'], 201);

    }

    /**
     * Delete a single rate plan
     * @param $property_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($property_id, $id) {

        try {
            if ( $this->ratePlanRepository->delete_rate_plan($property_id, $id) )
                return response()->json(['message' => 'DELETED'], 201);
        } catch( ModelNotFoundException $e) {
            // empty on purpose
        }
        return response()->json(['message' => 'Rate plan delete Failed!'], 409);

    }

}
