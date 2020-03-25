<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RoomTypesTest extends TestCase
{

    public function testUserCanCreateRoomType()
    {

        $this->post(env("API_ENDPOINT").'/1/roomtype', [
            'code'  =>  'SINGLE',
            'title' =>  'Single Room'
        ], $this->getHeaders());

        $this->assertResponseStatus(201);

    }

    public function testUserCanShowRoomType()
    {

        $this->get(env("API_ENDPOINT").'/1/roomtype/1', [], $this->getHeaders());

        $this->assertResponseStatus(201);
        $this->seeJson([
            'code'  =>  'SINGLE',
            'title' =>  'Single Room'
        ]);
    }

    public function testUserCanUpdateRoomType()
    {

        $this->put(env("API_ENDPOINT").'/1/roomtype/1', [
            'code'  =>  'SINGLE2',
            'title' =>  'Single Room2'
        ], $this->getHeaders());

        $this->assertResponseStatus(201);

        $this->seeJsonStructure(
            [
                'data' => [
                    'id',
                    'property_id',
                    'code',
                    'title',
                    'description',

                ],
                'message']
        );

        $this->seeJson([
            'code'  =>  'SINGLE2',
            'title' =>  'Single Room2'
        ]);
    }

    public function testUserCanDeleteRoomType()
    {

        $this->delete(env("API_ENDPOINT").'/1/roomtype/1', [], $this->getHeaders());

        $this->assertResponseStatus(201);

    }

    public function testUserCantDeleteUnexistingRoomType()
    {

        $this->delete(env("API_ENDPOINT").'/1/roomtype/2', [], $this->getHeaders());

        $this->assertResponseStatus(409);

    }


}
