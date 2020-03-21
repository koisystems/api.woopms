<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingChannel extends Model
{

    protected $table = 'booking_channels';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'is_active'
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

