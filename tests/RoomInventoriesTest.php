<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RoomInventoriesTest extends TestCase
{

    public function testUserCanCreateRoomInventory()
    {

        $this->post(env("API_ENDPOINT").'/1/roominventory', [
            'code'  =>  'SINGLE',
            'title' =>  'Single Room Inventory'
        ], $this->getHeaders());

        $this->assertResponseStatus(201);

    }

    public function testUserCanShowRoomInventory()
    {

        $this->get(env("API_ENDPOINT").'/1/roominventory/1', [], $this->getHeaders());

        $this->assertResponseStatus(201);
        $this->seeJson([
            'code'  =>  'SINGLE',
            'title' =>  'Single Room Inventory'
        ]);
    }

    public function testUserCanUpdateRoomInventory()
    {

        $this->put(env("API_ENDPOINT").'/1/roominventory/1', [
            'code'  =>  'SINGLE2',
            'title' =>  'Single Room Inventory2'
        ], $this->getHeaders());

        $this->assertResponseStatus(201);

        $this->seeJsonStructure(
            [
                'room_inventory' => [
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
            'title' =>  'Single Room Inventory2'
        ]);
    }

    public function testUserCanDeleteRoomInventory()
    {

        $this->delete(env("API_ENDPOINT").'/1/roominventory/1', [], $this->getHeaders());

        $this->assertResponseStatus(201);

    }

    public function testUserCantDeleteUnexistingRoomInventory()
    {

        $this->delete(env("API_ENDPOINT").'/1/roominventory/2', [], $this->getHeaders());

        $this->assertResponseStatus(409);

    }


}
