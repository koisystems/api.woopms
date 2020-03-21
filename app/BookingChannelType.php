<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingChannelType extends Model
{

    protected $table = 'booking_channel_types';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
         'name'
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

