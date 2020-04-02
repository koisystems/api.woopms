<?php

namespace App\Validators;
use App\Interfaces\ValidatorInterface;

class PolicyStoreValidator implements ValidatorInterface {

    CONST RULES   =    [
                'code' => 'required',
                'has_guarantee' => 'required',
                'has_deposit' => 'required',
                'has_cancellation_penalty' => 'required',
                'has_modification_penalty' => 'required',
            ];

    /**
     * Returns the validation rules for the validator
     * @return array|mixed
     */
    public static function rules() {
        return self::RULES;
    }
}
