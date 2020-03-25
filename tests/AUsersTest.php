<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AUsersTest extends TestCase
{

    public function testUserCanRegister()
    {


        $params =   array_merge($this->getLoginCredentials(), [
            'name'  =>  'Jose Silva',
            'password_confirmation' =>  '12345',
        ]);
        $this->post(env("API_ENDPOINT").'/auth/register', $params, []);

        $this->assertResponseStatus(201);
        $this->seeJsonStructure(
            [
                'data' => [
                    'name',
                    'email',
                    'id'
                ],
                'message']
        );


    }

    public function testUserCantRegisterSameCredentials()
    {

        $params =   array_merge($this->getLoginCredentials(), [
            'name'  =>  'Jose Silva',
            'password_confirmation' =>  '12345',
        ]);
        $this->post(env("API_ENDPOINT").'/auth/register', $params, []);

        $this->assertResponseStatus(422);

    }

    public function testUserCanLogin()
    {

        $this->post(env("API_ENDPOINT").'/auth/login', $this->getLoginCredentials(), []);

        $this->assertResponseStatus(200);
        $this->seeJsonStructure(
            ['token', 'token_type', 'expires_in']
        );
    }


}
