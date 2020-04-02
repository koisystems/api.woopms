<?php

namespace App\Interfaces;

interface ValidatorInterface {

    /**
     * Returns the array of rules defined for the validator
     * @return mixed
     */
    public static function rules();

}
