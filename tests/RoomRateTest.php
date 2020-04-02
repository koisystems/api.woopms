<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RoomRateTest extends TestCase
{

    public function testUserCanCreateMultipleRoomRate()
    {
        /* Create a Rate Plan*/
        $this->post(env("API_ENDPOINT").'/1/rateplan', [
            'code'  =>  'BAR',
            'title' =>  'Best Available Rate'
        ], $this->getHeaders());

        $response = json_decode($this->response->content(),1);

        $rateplanBAR   =   $response['data'];

        $this->post(env("API_ENDPOINT").'/1/rateplan', [
            'code'  =>  'NR',
            'title' =>  'Non Refundable'
        ], $this->getHeaders());

        $response = json_decode($this->response->content(),1);
        $rateplanNR   =   $response['data'];

        /* Create a RoomType */

        $this->post(env("API_ENDPOINT").'/1/roomtype', [
            'code'  =>  'SINGLE',
            'title' =>  'Single Room'
        ], $this->getHeaders());
        $response = json_decode($this->response->content(),1);
        $roomTypeSingle   =   $response['data'];

        $this->post(env("API_ENDPOINT").'/1/roomtype', [
            'code'  =>  'DOUBLE',
            'title' =>  'Double Room'
        ], $this->getHeaders());
        $response = json_decode($this->response->content(),1);
        $roomTypeDouble   =   $response['data'];

        /* The test */

        $this->post(env("API_ENDPOINT").'/1/roomrate', [
            'room_type_id'  =>  $roomTypeSingle['id'],
            'rate_plan_id' =>  [$rateplanBAR['id'], $rateplanNR['id']],
            'included_number_persons'   =>  2,
            'rack_rate' =>  100.15
        ], $this->getHeaders());
        $response = json_decode($this->response->content(),1);

        $this->seeJsonStructure(
            [
                'data' => [
                    [
                        'id',
                        'property_id',
                        'room_type_id',
                        'rate_plan_id',
                        'description',
                        'description',
                        'included_number_persons',
                        'max_number_persons',
                        'default_min_stay',
                        'rack_rate',
                        'extra_adult_rate',
                        'extra_child_rate'
                    ]
                ],
                'message']
        );

        $this->assertResponseStatus(201);

    }

    public function testUserCanShowRoomRate()
    {

        /* Create a Rate Plan*/
        $this->post(env("API_ENDPOINT").'/1/rateplan', [
            'code'  =>  'BAR',
            'title' =>  'Best Available Rate'
        ], $this->getHeaders());

        $response = json_decode($this->response->content(),1);
        $rateplanBAR   =   $response['data'];

        /* Create a RoomType */

        $this->post(env("API_ENDPOINT").'/1/roomtype', [
            'code'  =>  'SINGLE',
            'title' =>  'Single Room'
        ], $this->getHeaders());
        $response = json_decode($this->response->content(),1);
        $roomTypeSingle   =   $response['data'];

        /* The test */

        $this->post(env("API_ENDPOINT").'/1/roomrate', [
            'room_type_id'  =>  $roomTypeSingle['id'],
            'rate_plan_id' =>  [$rateplanBAR['id']],
            'included_number_persons'   =>  2,
            'rack_rate' =>  229.15
        ], $this->getHeaders());
        $response = json_decode($this->response->content(),1);
        $this->assertResponseStatus(201);


        $this->get(env("API_ENDPOINT").'/1/roomrate/'.$response['data'][0]['id'], [], $this->getHeaders());
        $this->assertResponseStatus(201);
        $this->seeJsonStructure(
            [
                'data' => [
                    [
                        'id',
                        'property_id',
                        'room_type_id',
                        'rate_plan_id',
                        'description',
                        'description',
                        'included_number_persons',
                        'max_number_persons',
                        'default_min_stay',
                        'rack_rate',
                        'extra_adult_rate',
                        'extra_child_rate'
                    ]
                ],
                'message']
        );
    }

    public function testUserCanUpdateRoomRate()
    {

        /* Create a Rate Plan*/
        $this->post(env("API_ENDPOINT").'/1/rateplan', [
            'code'  =>  'BAR',
            'title' =>  'Best Available Rate'
        ], $this->getHeaders());

        $response = json_decode($this->response->content(),1);
        $rateplanBAR   =   $response['data'];

        /* Create a RoomType */

        $this->post(env("API_ENDPOINT").'/1/roomtype', [
            'code'  =>  'SINGLE',
            'title' =>  'Single Room'
        ], $this->getHeaders());
        $response = json_decode($this->response->content(),1);
        $roomTypeSingle   =   $response['data'];

        $this->post(env("API_ENDPOINT").'/1/roomrate', [
            'room_type_id'  =>  $roomTypeSingle['id'],
            'rate_plan_id' =>  [$rateplanBAR['id']],
            'included_number_persons'   =>  2,
            'rack_rate' =>  229.15
        ], $this->getHeaders());
        $response = json_decode($this->response->content(),1);


        $this->put(env("API_ENDPOINT").'/1/roomrate/'.$response['data'][0]['id'], [
            'included_number_persons'  =>  '3',
            'rack_rate' =>  '99.25',
            'room_type_id'  =>  $roomTypeSingle['id'],
            'rate_plan_id' =>  $rateplanBAR['id'],
        ], $this->getHeaders());

        $this->assertResponseStatus(201);

        $this->seeJsonStructure(
            [
                'data' => [
                        'id',
                        'property_id',
                        'room_type_id',
                        'rate_plan_id',
                        'description',
                        'description',
                        'included_number_persons',
                        'max_number_persons',
                        'default_min_stay',
                        'rack_rate',
                        'extra_adult_rate',
                        'extra_child_rate'

                ],
                'message']
        );


    }

    public function testUserCanDeleteRatePlan()
    {

        /* Create a Rate Plan*/
        $this->post(env("API_ENDPOINT").'/1/rateplan', [
            'code'  =>  'BAR',
            'title' =>  'Best Available Rate'
        ], $this->getHeaders());

        $response = json_decode($this->response->content(),1);
        $rateplanBAR   =   $response['data'];

        /* Create a RoomType */

        $this->post(env("API_ENDPOINT").'/1/roomtype', [
            'code'  =>  'SINGLE',
            'title' =>  'Single Room'
        ], $this->getHeaders());
        $response = json_decode($this->response->content(),1);
        $roomTypeSingle   =   $response['data'];

        $this->post(env("API_ENDPOINT").'/1/roomrate', [
            'room_type_id'  =>  $roomTypeSingle['id'],
            'rate_plan_id' =>  [$rateplanBAR['id']],
            'included_number_persons'   =>  2,
            'rack_rate' =>  229.15
        ], $this->getHeaders());
        $response = json_decode($this->response->content(),1);


        $this->delete(env("API_ENDPOINT").'/1/roomrate/'.$response['data'][0]['id'], [], $this->getHeaders());

        $this->assertResponseStatus(201);

    }
/*
    public function testUserCantDeleteUnexistingRatePlan()
    {

        $this->delete(env("API_ENDPOINT").'/1/rateplan/2', [], $this->getHeaders());

        $this->assertResponseStatus(409);

    }

*/
}
