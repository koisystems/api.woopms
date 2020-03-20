<?php
namespace App\Transformers;

use App\Room;
use League\Fractal;

class RoomTransformer extends Fractal\TransformerAbstract
{
    public function transform(Room $room)
    {
        return [
            'id'                => (int) $room->id,
            'property_id'       => (int) $room->propery_id,
            'room_inventory_id' => (int) $room->room_inventory_id,
            'code'              => (string) $room->code,
            'title'             => (string) $room->title,
            'description'       => (string) $room->description,
        ];
    }
}
