<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PolicyRulesTestTest extends TestCase
{

    public function testUserCanCreatePolicyRule()
    {

        $this->post(env("API_ENDPOINT").'/1/policy/1/policyrule', [
            'type'              =>  'cancellation',
            'hours_before'      => '24',
            'charge_based_on'   => 'number_nights',
            'amount'            => '1',
        ], $this->getHeaders());

        $this->assertResponseStatus(201);

    }

    public function testUserCanShowPolicyRule()
    {

        $this->get(env("API_ENDPOINT").'/1/policy/1/policyrule/1', [], $this->getHeaders());

        $this->assertResponseStatus(201);
        $this->seeJson([
            'type'              =>  'cancellation',
            'hours_before'      => 24,
            'charge_based_on'   => 'number_nights',
            'amount'            => 1,
        ]);
    }

    public function testUserCanUpdatePolicyRule()
    {

        $this->put(env("API_ENDPOINT").'/1/policy/1/policyrule/1', [
            'type'              =>  'modification',
            'hours_before'      => '12',
            'charge_based_on'   => 'fixed_amount',
            'amount'            => '100',
        ], $this->getHeaders());


        $this->assertResponseStatus(201);

        $this->seeJsonStructure(
            [
                'policy_rule' => [
                    'type',
                    'hours_before',
                    'charge_based_on',
                    'amount',

                ],
                'message']
        );

        $this->seeJson([
            'type'              =>  'modification',
            'hours_before'      => "12",
            'charge_based_on'   => 'fixed_amount',
            'amount'            => "100",
        ]);
    }

    public function testUserCanDeletePolicyRule()
    {

        $this->delete(env("API_ENDPOINT").'/1/policy/1/policyrule/1', [], $this->getHeaders());

        $this->assertResponseStatus(201);

    }

    public function testUserCantDeleteUnexistingPolicyRule()
    {

        $this->delete(env("API_ENDPOINT").'/1/policy/1/policyrule/1', [], $this->getHeaders());

        $this->assertResponseStatus(409);

    }


}
