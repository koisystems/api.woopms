<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PoliciesTest extends TestCase
{

    public function testUserCanCreatePolicy()
    {

        $this->post(env("API_ENDPOINT").'/1/policy', [
            'code'  =>  'DFL_CXL',
            'has_guarantee' => '1',
            'has_deposit' => '1',
            'has_cancellation_penalty' => '1',
            'has_modification_penalty' => '1',
        ], $this->getHeaders());

        $this->assertResponseStatus(201);

    }

    public function testUserCanShowPolicy()
    {

        $this->get(env("API_ENDPOINT").'/1/policy/1', [], $this->getHeaders());

        $this->assertResponseStatus(201);
        $this->seeJson([
                'code'  =>  'DFL_CXL',
                'has_guarantee' => 1,
                'has_deposit' => 1,
                'has_cancellation_penalty' => 1,
                'has_modification_penalty' => 1,
        ]);
    }

    public function testUserCanUpdatePolicy()
    {

        $this->put(env("API_ENDPOINT").'/1/policy/1', [
            'code'  =>  'DFL_CXL_0',
            'has_guarantee' => '0',
            'has_deposit' => '0',
            'has_cancellation_penalty' => '0',
            'has_modification_penalty' => '0',
        ], $this->getHeaders());

        $this->assertResponseStatus(201);

        $this->seeJsonStructure(
            [
                'policy' => [
                    'id',
                    'code',
                    'has_guarantee',
                    'has_deposit',
                    'has_cancellation_penalty',
                    'has_modification_penalty',

                ],
                'message']
        );

        $this->seeJson([
            'code'  =>  'DFL_CXL_0',
            'has_guarantee' => '0',
            'has_deposit' => '0',
            'has_cancellation_penalty' => '0',
            'has_modification_penalty' => '0',
        ]);
    }

    public function testUserCanDeletePolicy()
    {

        $this->delete(env("API_ENDPOINT").'/1/policy/1', [], $this->getHeaders());

        $this->assertResponseStatus(201);

    }

    public function testUserCantDeleteUnexistingPolicy()
    {

        $this->delete(env("API_ENDPOINT").'/1/policy/2', [], $this->getHeaders());

        $this->assertResponseStatus(409);

    }


}
