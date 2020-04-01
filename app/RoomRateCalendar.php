<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomRateCalendar extends Model
{

    protected $table = 'room_rate_calendar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'property_id', 'room_type_id', 'rate_plan_id', 'room_rate_id', 'stay_date','rate_amount'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'id','created_at', 'updated_at'
    ];

}

