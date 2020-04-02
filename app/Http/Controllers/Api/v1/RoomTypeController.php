<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use App\Interfaces\RoomTypeInterface;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use  App\User;
use  App\RoomType;
use  App\Repositories\RoomTypeRepository;

class RoomTypeController extends Controller
{

    private $roomTypeRepository;

    public function __construct(RoomTypeInterface $roomTypeRepository)
    {
        $this->roomTypeRepository  =   $roomTypeRepository;
    }

    /**
     * Create a new Room Type
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
            return response()->json(['message' => 'Room Type Creation Failed!'], 409);

        }

        $roomType  =   $this->roomTypeRepository->create_room_type($property_id, $request);

        return response()->json(['data' => $roomType, 'message' => 'CREATED'], 201);


    }

    /**
     * Update an existing room type
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
            return response()->json(['message' => 'Room Type Update Failed!'], 409);

        }

        $roomType  =   $this->roomTypeRepository->update_room_type($property_id, $id, $request);

        return response()->json(['data' => $roomType, 'message' => 'UPDATED'], 201);


    }

    /**
     * Get a single or a list of Room Types
     * @param $property_id
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($property_id, $id = null) {

        $roomTypes    =   $this->roomTypeRepository->get_room_types($property_id, $id);

        return response()->json(['data' => $roomTypes, 'message' => 'GET'], 201);

    }

    /**
     * Delete a single room type
     * @param $property_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($property_id, $id) {

        try {

            if ( $this->roomTypeRepository->delete_room_type($property_id, $id) )
                return response()->json(['message' => 'DELETED'], 201);
        } catch( ModelNotFoundException $e) {
            // empty on purpose
        }
        return response()->json(['message' => 'Room Type delete Failed!'], 409);

    }

}
