<?php

namespace App\Validators;
use App\Interfaces\ValidatorInterface;

class PolicyRuleStoreValidator implements ValidatorInterface {

    CONST RULES   =    [
        'type'              =>  'required',
        'hours_before'      => 'required',
        'charge_based_on'   => 'required',
        'amount'            => 'required',
    ];

    /**
     * Returns the validation rules for the validator
     * @return array|mixed
     */
    public static function rules() {
        return self::RULES;
    }
}
