<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RatePlanTest extends TestCase
{

    public function testUserCanCreateRatePlan()
    {

        $this->post(env("API_ENDPOINT").'/1/rateplan', [
            'code'  =>  'BAR',
            'title' =>  'Best Available Rate'
        ], $this->getHeaders());

        $this->assertResponseStatus(201);

    }

    public function testUserCanShowRatePlan()
    {

        $this->get(env("API_ENDPOINT").'/1/rateplan/1', [], $this->getHeaders());

        $this->assertResponseStatus(201);
        $this->seeJson([
            'code'  =>  'BAR',
            'title' =>  'Best Available Rate'
        ]);
    }

    public function testUserCanUpdateRatePlan()
    {

        $this->put(env("API_ENDPOINT").'/1/rateplan/1', [
            'code'  =>  'BAR2',
            'title' =>  'Best Available Rate 2'
        ], $this->getHeaders());

        $this->assertResponseStatus(201);

        $this->seeJsonStructure(
            [
                'rate_plan' => [
                    'id',
                    'property_id',
                    'code',
                    'title',
                    'description',

                ],
                'message']
        );

        $this->seeJson([
            'code'  =>  'BAR2',
            'title' =>  'Best Available Rate 2'
        ]);
    }

    public function testUserCanDeleteRatePlan()
    {

        $this->delete(env("API_ENDPOINT").'/1/rateplan/1', [], $this->getHeaders());

        $this->assertResponseStatus(201);

    }

    public function testUserCantDeleteUnexistingRatePlan()
    {

        $this->delete(env("API_ENDPOINT").'/1/rateplan/2', [], $this->getHeaders());

        $this->assertResponseStatus(409);

    }


}
