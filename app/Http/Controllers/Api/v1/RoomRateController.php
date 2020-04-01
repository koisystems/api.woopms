<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use App\Interfaces\RoomRateCalendarInterface;
use App\Interfaces\RoomRateInterface;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use  App\User;
use  App\RoomType;
use  App\RatePlan;

use  App\Repositories\RoomRateRepository;

class RoomRateController extends Controller
{

    private $roomRateRepository;

    public function __construct(RoomRateInterface $roomRateRepository, RoomRateCalendarInterface $roomRateCalendarRepository)
    {
        $this->middleware('auth');
        $this->roomRateRepository  =   $roomRateRepository;
        $this->roomRateCalendarRepository  =   $roomRateCalendarRepository;

    }

    /**
     * Create a new Room Rate
     * @param $property_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create($property_id, Request $request) {

        try {
            $this->validate($request, [
                'room_type_id' => 'required',
                'rate_plan_id' => 'required',
                'rack_rate' => 'required',
                'included_number_persons'   =>  'required'
            ]);
        } catch( Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Room Rate Creation Failed!'], 409);

        }

        $roomRate  =   $this->roomRateRepository->create($property_id, $request);

        return response()->json(['data' => $roomRate, 'message' => 'CREATED'], 201);


    }

    /**
     * Update an existing room rate
     * @param $property_id
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($property_id, $id, Request $request) {

        try {
            $this->validate($request, []);
        } catch( Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Room Type Update Failed!'], 409);

        }

        $data  =   $this->roomRateRepository->update($property_id, $id, $request);

        return response()->json(['data' => $data, 'message' => 'UPDATED'], 201);


    }

    /**
     * Get a single or a list of Room Types
     * @param $property_id
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($property_id, $id = null) {

        $data    =   $this->roomRateRepository->get($property_id, $id);

        return response()->json(['data' => $data, 'message' => 'GET'], 201);

    }

    /**
     * Delete a single room type
     * @param $property_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($property_id, $id) {

        try {

            if ( $this->roomRateRepository->delete($property_id, $id) )
                return response()->json(['message' => 'DELETED'], 201);
        } catch( ModelNotFoundException $e) {
            // empty on purpose
        }
        return response()->json(['message' => 'Room Rate delete Failed!'], 409);

    }

    public function bulkUpdate($property_id, Request $request) {

        try {
            $this->validate($request, [
                'room_type_id' => 'required',
                'rate_plan_id' => 'required',
                'from_date' => 'required',
                'until_date'   =>  'required',
                'rate_amount' => 'required'
            ]);
        } catch( Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Room Rate Calendar Creation Failed!'], 409);

        }

        $roomRate  =   $this->roomRateCalendarRepository->create($property_id, $request);

        return response()->json(['data' => $roomRate, 'message' => 'CREATED'], 201);
    }


}
