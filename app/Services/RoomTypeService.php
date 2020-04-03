<?php

namespace App\Services;

use App\Interfaces\RoomTypeInterface;
use App\Services\Interfaces\RoomTypeServiceInterface;
use App\Validators\RoomTypeStoreValidator;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Http\Request;

use League\Fractal;
use League\Fractal\Manager;
use App\Transformers\RoomTypeTransformer;
use Validator;

class RoomTypeService implements RoomTypeServiceInterface{

    public function __construct(RoomTypeInterface $roomTypeRepository)
    {
        $this->roomTypeRepository  =   $roomTypeRepository;
    }

    public function create_room_type( int $property_id, Request $request) {

        $validator = Validator::make($request->all(), RoomTypeStoreValidator::rules());
        if ($validator->fails()) {
            throw new \Exception();
        }

        /** Is there a better way to do this ? */
        $requestData    =   [
            'property_id'   =>  $property_id,
        ];
        $requestData = array_merge($requestData, $request->all());


        $roomType = $this->roomTypeRepository->create($requestData);

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Item($roomType, new RoomTypeTransformer());
        return $fractal->createData($resource)->toArray()['data'];
    }

    public function update_room_type(int $property_id, int $room_inventory_id, Request $request) {
        $validator = Validator::make($request->all(), RoomTypeStoreValidator::rules());
        if ($validator->fails()) {
            throw new \Exception();
        }

        $roomType = $this->roomTypeRepository->update($room_inventory_id, $property_id, $request->all());

        $fractal = new Manager();
        $resource =  new Fractal\Resource\Item($roomType, new RoomTypeTransformer());
        return $fractal->createData($resource)->toArray()['data'];

    }

    public function delete_room_type( int $property_id, int $room_inventory_id) {


        return $this->roomTypeRepository->delete($property_id, $room_inventory_id);
    }

    public function get_room_types(int $property_id, $room_type_id) {

        $roomTypes = $this->roomTypeRepository->get($property_id, $room_type_id);


        $fractal = new Manager();
        $resource =  new Fractal\Resource\Collection($roomTypes, new RoomTypeTransformer());
        return $fractal->createData($resource)->toArray()['data'];

    }
}
