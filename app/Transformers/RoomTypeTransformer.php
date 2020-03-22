<?php
namespace App\Transformers;

use App\RoomType;
use League\Fractal;

class RoomTypeTransformer extends Fractal\TransformerAbstract
{
    public function transform(RoomType $roomType)
    {

        return [
            'id'            => (int) $roomType->id,
            'property_id'   => (int) $roomType->propery_id,
            'code'          => (string) $roomType->code,
            'title'         => (string) $roomType->title,
            'description'   => (string) $roomType->description,
            'max_persons'   => (int) $roomType->max_persons,
            'max_adults'    => (int) $roomType->max_adults,
            'max_children'  => (int) $roomType->max_children,
            'max_infants'   => (int) $roomType->max_infants,
            'number_units'  => (int) $roomType->number_units,
        ];
    }
}
