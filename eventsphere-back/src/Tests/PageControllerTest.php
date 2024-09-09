<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{

    public function testLoginPage()
    {
        $client = static::createClient([
            'HTTP_HOST' => 'localhost:8000',
        ]);

        $data = [
            'email' => 'test0@test.com',
            'password' => 'password0',
        ];

        $client->request('POST', '/api/login', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode($data));

        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        // Optionally log response content for debugging
        file_put_contents('response_debug.log', $response->getContent());

    }


    protected function tearDown(): void
    {
        // Cleanup code if needed
        restore_exception_handler();
        parent::tearDown();
    }

}