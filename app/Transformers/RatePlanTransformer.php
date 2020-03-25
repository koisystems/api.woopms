<?php
namespace App\Transformers;

use App\RatePlan;
use League\Fractal;

class RatePlanTransformer extends Fractal\TransformerAbstract
{
    public function transform(RatePlan $ratePlan)
    {
        return [
            'id'            => (int) $ratePlan->id,
            'property_id'   => (int) $ratePlan->property_id,
            'code'          => (string) $ratePlan->code,
            'title'         => (string) $ratePlan->title,
            'description'   => (string) $ratePlan->description,
            'min_persons'   => (int) $ratePlan->min_persons,
            'max_persons'   => (int) $ratePlan->max_persons,
            'min_stay'   => (int) $ratePlan->min_stay,
            'max_stay'   => (int) $ratePlan->max_stay,
            'cutoff_days'   => (int) $ratePlan->cutoff_days,
            'allotment'   => (int) $ratePlan->allotment,
            'commissionable'   => (int) $ratePlan->commissionable,
            'is_special_rate'   => (int) $ratePlan->is_special_rate,
        ];
    }
}
