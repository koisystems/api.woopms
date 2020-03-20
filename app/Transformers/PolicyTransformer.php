<?php
namespace App\Transformers;

use App\Policy;
use League\Fractal;

class PolicyTransformer extends Fractal\TransformerAbstract
{
    public function transform(Policy $policy)
    {
        return [

            'id'                        => (int) $policy->id,
            'property_id'               => (int) $policy->propery_id,
            'code'                      => (string) $policy->code,
            'has_guarantee'             => (int) $policy->has_guarantee,
            'has_deposit'               => (int) $policy->has_deposit,
            'has_cancellation_penalty'  => (int) $policy->has_cancellation_penalty,
            'has_modification_penalty'  => (int) $policy->has_modification_penalty,

        ];
    }
}
