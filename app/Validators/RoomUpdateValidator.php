<?php

namespace App\Validators;
use App\Interfaces\ValidatorInterface;

class RoomUpdateValidator implements ValidatorInterface {

    CONST RULES   =    [
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
