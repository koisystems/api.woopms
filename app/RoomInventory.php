<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomInventory extends Model
{

    protected $table = 'room_inventories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'property_id', 'code', 'title', 'description', 'max_persons', 'max_adults', 'max_children', 'max_infants', 'number_units'
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

