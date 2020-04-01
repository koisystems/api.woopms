<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Carbon\Carbon;

class RoomRateCalendarTest extends TestCase
{

    public function testUserCanCreateSingleRoomRateCalendar()
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


        /* Room Rate */

        $this->post(env("API_ENDPOINT").'/1/roomrate', [
            'room_type_id'  =>  $roomTypeSingle['id'],
            'rate_plan_id' =>  [$rateplanBAR['id']],
            'included_number_persons'   =>  2,
            'rack_rate' =>  100.15
        ], $this->getHeaders());
        $response = json_decode($this->response->content(),1);

        $roomRate   =   $response['data'];

        $this->post(env("API_ENDPOINT").'/1/roomrate/bulk', [
            'room_type_id'  =>  $roomTypeSingle['id'],
            'rate_plan_id' =>  $rateplanBAR['id'],
            'room_rate_id' =>  $roomRate[0]['id'],
            'from_date'   =>  Carbon::now()->format("Y-m-d"),
            'until_date' =>  Carbon::now()->addDays(15)->format("Y-m-d"),
            'rate_amount'   => 99.72
        ], $this->getHeaders());
        $response = json_decode($this->response->content(),1);

        $this->assertResponseStatus(201);

        sleep(2);
        $this->post(env("API_ENDPOINT").'/1/roomrate/bulk', [
            'room_type_id'  =>  $roomTypeSingle['id'],
            'rate_plan_id' =>  $rateplanBAR['id'],
            'room_rate_id' =>  $roomRate[0]['id'],
            'from_date'   =>  Carbon::now()->format("Y-m-d"),
            'until_date' =>  Carbon::now()->addDays(15)->format("Y-m-d"),
            'rate_amount'   => 199.72
        ], $this->getHeaders());
        $response = json_decode($this->response->content(),1);

    }

}
