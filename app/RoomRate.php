<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomRate extends Model
{

    protected $table = 'room_rates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'property_id', 'room_type_id', 'rate_plan_id', 'description', 'included_number_persons','max_number_persons',
        'default_min_stay','rack_rate','default_min_stay','extra_adult_rate','extra_child_rate'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * Get the inventory for the room.
     */
    public function roomtype()
    {
        return $this->belongsTo('App\RoomType');
    }

}

