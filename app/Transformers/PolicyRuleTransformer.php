<?php
namespace App\Transformers;

use App\PolicyRule;
use League\Fractal;

class PolicyRuleTransformer extends Fractal\TransformerAbstract
{
    public function transform(PolicyRule $rule)
    {
        return [
            'id'      => (int) $rule->id,
            'property_id'   => (int) $rule->propery_id,
            'policy_id'   => (int) $rule->policy_id,
            'hours_before'   => (int) $rule->hours_before,
            'type'   => (string) $rule->type,
            'charge_based_on'   => (string) $rule->charge_based_on,
            'amount'   => (float) $rule->amount,
        ];
    }
}
