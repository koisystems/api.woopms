<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PolicyRule extends Model
{

    protected $table = 'policy_rules';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'property_id', 'policy_id', 'hours_before', 'charge_based_on', 'amount'
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

    /**
     * Get the policy that has rule attached
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function policy()
    {
        return $this->belongsTo('App\Policy');
    }
}

