<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatePlan extends Model
{

    protected $table = 'rate_plans';

    /**
     * The attributes that are mass assignable.
     *  $table->integer("property_id");
    $table->string("code");
    $table->string("title");
    $table->string("description")->nullable();
    $table->integer("min_persons")->default(1);
    $table->integer("max_persons")->nullable();
    $table->integer("min_stay")->default(1);
    $table->integer("max_stay")->nullable();
    $table->string("period")->default("daily");

    $table->integer("cutoff_days")->nullable();
    $table->integer("allotment")->default(1);
    $table->boolean("commissionable")->default(true);
    $table->boolean("is_special_rate")->default(false);
     * @var array
     */
    protected $fillable = [
        'property_id', 'code', 'title', 'description', 'min_persons', 'max_persons', 'min_stay', 'max_stay', 'period',
        'cutoff_days', 'allotment', 'commissionable', 'is_special_rate'
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
    public function property()
    {
        return $this->belongsTo('App\Property');
    }

}

