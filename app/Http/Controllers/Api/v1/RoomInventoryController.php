<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use  App\User;
use  App\RoomInventory;

class RoomInventoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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

        /** Is there a better way to do this ? */
        $requestData    =   [
            'property_id'   =>  $property_id,
        ];
        $requestData = array_merge($requestData, $request->all());


        $roomInventory = RoomInventory::create($requestData);
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


        $roomInventory = RoomInventory::where("id", $id)->where("property_id", $property_id)->firstOrFail();
        $roomInventory->update($request->all());

        return response()->json(['room_inventory' => $roomInventory, 'message' => 'UPDATED'], 201);


    }

    /**
     * Get a single or a list of RoomInventory
     * @param $property_id
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($property_id, $id = null) {

        if(is_null($id)) {
            $roomInventories = RoomInventory::where("property_id", $property_id)->get();
        } else {
            $roomInventories = RoomInventory::where("id", $id)->where("property_id", $property_id)->get();
        }
        return response()->json(['room_inventory' => $roomInventories->toArray(), 'message' => 'GET'], 201);

    }

    /**
     * Delete a single room inventory
     * @param $property_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($property_id, $id) {

        try {
            $roomInventory = RoomInventory::where("id", $id)->where("property_id", $property_id)->firstOrFail();
            if ($roomInventory->delete())
                return response()->json(['message' => 'DELETED'], 201);
        } catch( ModelNotFoundException $e) {
            // empty on purpose
        }
        return response()->json(['message' => 'Room Inventory delete Failed!'], 409);

    }

}
