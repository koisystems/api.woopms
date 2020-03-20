<?php
namespace App\Transformers;

use App\RoomInventory;
use League\Fractal;

class RoomInventoryTransformer extends Fractal\TransformerAbstract
{
    public function transform(RoomInventory $roomInventory)
    {

        return [
            'id'            => (int) $roomInventory->id,
            'property_id'   => (int) $roomInventory->propery_id,
            'code'          => (string) $roomInventory->code,
            'title'         => (string) $roomInventory->title,
            'description'   => (string) $roomInventory->description,
            'max_persons'   => (int) $roomInventory->max_persons,
            'max_adults'    => (int) $roomInventory->max_adults,
            'max_children'  => (int) $roomInventory->max_children,
            'max_infants'   => (int) $roomInventory->max_infants,
            'number_units'  => (int) $roomInventory->number_units,
        ];
    }
}
