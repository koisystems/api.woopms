<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{

    protected $table = 'policies';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'property_id', 'code', 'text', 'has_guarantee', 'has_deposit', 'has_cancellation_penalty', 'has_modification_penalty'
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
     * Get the property for the room.
     */
    public function property()
    {
        return $this->belongsTo('App\Property');
    }

    /**
     * Get the rules attached
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rules()
    {
        return $this->hasMany('App\PolicyRules');
    }
}

