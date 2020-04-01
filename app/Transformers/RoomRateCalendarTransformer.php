<?php
namespace App\Transformers;

use App\RoomRateCalendar;
use League\Fractal;

class RoomRateCalendarTransformer extends Fractal\TransformerAbstract
{
    public function transform(RoomRateCalendar $object)
    {
        return [
            'id'                        => (int) $object->id,
            'property_id'               => (int) $object->property_id,
            'room_type_id'              => (int) $object->room_type_id,
            'rate_plan_id'              => (int) $object->rate_plan_id,
            'room_rate_id'              => (int) $object->room_rate_id,
            'rate_amount'               => (float) $object->rate_amount,
            'stay_date'                 => (string) $object->stay_date
        ];
    }
}
