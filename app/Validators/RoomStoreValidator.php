<?php

namespace App\Validators;
use App\Interfaces\ValidatorInterface;

class RoomStoreValidator implements ValidatorInterface {

    CONST RULES   =    [
        'room_type_id' => 'required',
        'code' => 'required',
        'title' => 'required',
    ];

    /**
     * Returns the validation rules for the validator
     * @return array|mixed
     */
    public static function rules() {
        return self::RULES;
    }
}
