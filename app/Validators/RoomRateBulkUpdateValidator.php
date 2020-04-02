<?php

namespace App\Validators;
use App\Interfaces\ValidatorInterface;

class RoomRateBulkUpdateValidator implements ValidatorInterface {

    CONST RULES   =    [
        'room_type_id'  => 'required',
        'rate_plan_id'  => 'required',
        'from_date'     => 'required',
        'until_date'    =>  'required',
        'rate_amount'   => 'required'
    ];

    /**
     * Returns the validation rules for the validator
     * @return array|mixed
     */
    public static function rules() {
        return self::RULES;
    }
}
