<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileType extends Model
{

    protected $table = 'profile_types';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'ota_code'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];


}

