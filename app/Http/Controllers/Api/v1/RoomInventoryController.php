<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use App\Interfaces\RoomInventoryInterface;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use  App\User;
use  App\RoomInventory;
use  App\Repositories\RoomInventoryRepository;

class RoomInventoryController extends Controller
{

    private $roomInventoryRepository;

    public function __construct(RoomInventoryInterface $roomInventoryRepository)
    {
        $this->middleware('auth');
        $this->roomInventoryRepository  =   $roomInventoryRepository;
    }

    /**
     * Create a new Room Inventory
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
            return response()->json(['message' => 'Room Inventory Creation Failed!'], 409);

        }

        $roomInventory  =   $this->roomInventoryRepository->create_room_inventory($property_id, $request);

        return response()->json(['room_inventory' => $roomInventory, 'message' => 'CREATED'], 201);


    }

    /**
     * Update an existing room inventory
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
            return response()->json(['message' => 'Room Inventory Update Failed!'], 409);

        }

        $roomInventory  =   $this->roomInventoryRepository->update_room_inventory($property_id, $id, $request);

        return response()->json(['room_inventory' => $roomInventory, 'message' => 'UPDATED'], 201);


    }

    /**
     * Get a single or a list of RoomInventory
     * @param $property_id
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($property_id, $id = null) {

        $roomInventories    =   $this->roomInventoryRepository->get_room__inventories($property_id, $id);

        return response()->json(['room_inventory' => $roomInventories, 'message' => 'GET'], 201);

    }

    /**
     * Delete a single room inventory
     * @param $property_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($property_id, $id) {

        try {

            if ( $this->roomInventoryRepository->delete_room_inventory($property_id, $id) )
                return response()->json(['message' => 'DELETED'], 201);
        } catch( ModelNotFoundException $e) {
            // empty on purpose
        }
        return response()->json(['message' => 'Room Inventory delete Failed!'], 409);

    }

}
