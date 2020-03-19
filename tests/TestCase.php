<?php

use Laravel\Lumen\Testing\TestCase as BaseTestCase;
use Dotenv\Dotenv;

abstract class TestCase extends BaseTestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function getHeaders() {

        $this->post('/api/v1/auth/login', $this->getLoginCredentials(), []);
        $response =  json_decode($this->response->getContent(), true);

        $token  =   $response['token'];
        $headers    =   [
            'HTTP_Authorization' => 'Bearer ' . $token
        ];

        return $headers;
    }

    public function getLoginCredentials() {
        return [
            'email' =>  'jose@koisys.com',
            'password' => "12345",
        ];
    }
}
