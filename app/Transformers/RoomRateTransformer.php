<?php
namespace App\Transformers;

use App\RoomRate;
use League\Fractal;

class RoomRateTransformer extends Fractal\TransformerAbstract
{
    public function transform(RoomRate $object)
    {
        return [
            'id'                        => (int) $object->id,
            'property_id'               => (int) $object->property_id,
            'room_type_id'              => (int) $object->room_type_id,
            'rate_plan_id'              => (int) $object->rate_plan_id,
            'description'               => (string) $object->description,
            'included_number_persons'   => (int) $object->included_number_persons,
            'max_number_persons'        => (int) $object->max_number_persons,
            'default_min_stay'          => (int) $object->default_min_stay,
            'rack_rate'                 => (float) $object->rack_rate,
            'default_min_stay'          => (int) $object->default_min_stay,
            'extra_adult_rate'          => (float) $object->extra_adult_rate,
            'extra_child_rate'          => (float) $object->extra_child_rate,

        ];
    }
}
