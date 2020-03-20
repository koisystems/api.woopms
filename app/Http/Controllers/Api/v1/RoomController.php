<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use  App\User;
use  App\RoomInventory;
use  App\Room;
use  App\Interfaces\RoomInterface;

class RoomController extends Controller
{

    private $roomRepository;

    public function __construct( RoomInterface $roomRepository)
    {
        $this->middleware('auth');
        $this->roomRepository   =   $roomRepository;
    }

    /**
     * Create a new Room
     * @param $property_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create($property_id, Request $request) {

        try {
            $this->validate($request, [
                'room_inventory_id' => 'required',
                'code' => 'required',
                'title' => 'required',
            ]);
        } catch( Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Room Creation Failed!'], 409);

        }

        $room   =   $this->roomRepository->create_room($property_id, $request);

        return response()->json(['room' => $room, 'message' => 'CREATED'], 201);


    }

    /**
     * Update an existing room
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
            return response()->json(['message' => 'Room Update Failed!'], 409);

        }

        $room   =   $this->roomRepository->update_room($property_id, $id, $request);

        return response()->json(['room' => $room, 'message' => 'UPDATED'], 201);


    }

    /**
     * Get a single or a list of Room
     * @param $property_id
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($property_id, $id = null) {

        $rooms =  $this->roomRepository->get_rooms($property_id, $id);

        return response()->json(['rooms' => $rooms, 'message' => 'GET'], 201);

    }

    /**
     * Delete a single room
     * @param $property_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($property_id, $id) {

        try {
            if ( $this->roomRepository->delete_room($property_id, $id))
                return response()->json(['message' => 'DELETED'], 201);
        } catch( ModelNotFoundException $e) {
            // empty on purpose
        }
        return response()->json(['message' => 'Room delete Failed!'], 409);

    }

}
