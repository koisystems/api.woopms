<?php

namespace App\Validators;
use App\Interfaces\ValidatorInterface;

class RoomRateStoreValidator implements ValidatorInterface {

    CONST RULES   =    [
        'room_type_id' => 'required',
        'rate_plan_id' => 'required',
        'rack_rate' => 'required',
        'included_number_persons'   =>  'required'
    ];

    /**
     * Returns the validation rules for the validator
     * @return array|mixed
     */
    public static function rules() {
        return self::RULES;
    }
}
