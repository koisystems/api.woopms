<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RoomsTest extends TestCase
{

    public function testUserCanCreateRoom()
    {

        $this->post(env("API_ENDPOINT").'/1/room', [
            'room_type_id' => 1,
            'code'  =>  'ROOM1',
            'title' =>  'Room 1'
        ], $this->getHeaders());

        $this->assertResponseStatus(201);

    }

    public function testUserCanShowRoom()
    {

        $this->get(env("API_ENDPOINT").'/1/room/1', [], $this->getHeaders());

        $this->assertResponseStatus(201);
        $this->seeJson([
            'code'  =>  'ROOM1',
            'title' =>  'Room 1'
        ]);
    }

    public function testUserCanUpdateRoom()
    {

        $this->put(env("API_ENDPOINT").'/1/room/1', [
            'code'  =>  'ROOM12',
            'title' =>  'Room 12'
        ], $this->getHeaders());

        $this->assertResponseStatus(201);

        $this->seeJsonStructure(
            [
                'room' => [
                    'id',
                    'property_id',
                    'room_type_id',
                    'code',
                    'title',
                    'description',

                ],
                'message']
        );

        $this->seeJson([
            'code'  =>  'ROOM12',
            'title' =>  'Room 12'
        ]);
    }

    public function testUserCanDeleteRoom()
    {

        $this->delete(env("API_ENDPOINT").'/1/room/1', [], $this->getHeaders());

        $this->assertResponseStatus(201);

    }

    public function testUserCantDeleteUnexistingRoom()
    {

        $this->delete(env("API_ENDPOINT").'/1/room/20', [], $this->getHeaders());

        $this->assertResponseStatus(409);

    }


}
