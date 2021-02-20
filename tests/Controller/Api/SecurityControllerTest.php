<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends WebTestCase
{
    public function testRegisterEmptyRequest(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/register', [], [], [], json_encode([]));
        static::assertSame(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());
    }

    public function testRegister(): void
    {
        $client = static::createClient();
        $client->setServerParameter('CONTENT_TYPE', 'application/json');

        $email = uniqid('p', true) . '@test.de';
        $username = uniqid('p', true);

        // Register
        $client->request('POST', '/api/register', [], [], [], json_encode(['username' => $username, 'password' => 'test', 'email' => $email]));
        static::assertSame(Response::HTTP_NO_CONTENT, $client->getResponse()->getStatusCode());

        // Try to obtain a JWT Token
        $client->request('POST', '/api/login', [], [], [], json_encode(['username' => $email, 'password' => 'test']));
        static::assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        // Verify response
        $body = json_decode($client->getResponse()->getContent(), true);
        static::assertArrayHasKey('token', $body);
        static::assertNotEmpty($body['token']);
    }

    public function testRegisterSecondTime(): void
    {
        $client = static::createClient();
        $client->setServerParameter('CONTENT_TYPE', 'application/json');

        $email = uniqid('p', true) . '@test.de';
        $username = uniqid('p', true);

        // Register
        $client->request('POST', '/api/register', [], [], [], json_encode(['username' => $username, 'password' => 'test', 'email' => $email]));
        static::assertSame(Response::HTTP_NO_CONTENT, $client->getResponse()->getStatusCode());

        // Register again with same email
        $client->request('POST', '/api/register', [], [], [], json_encode(['username' => $username, 'password' => 'test', 'email' => $email]));
        static::assertSame(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());

        $body = json_decode($client->getResponse()->getContent(), true);
        static::assertSame('Email address is already given', $body['message']);

        // Register again with same username
        $client->request('POST', '/api/register', [], [], [], json_encode(['username' => $username, 'password' => 'test', 'email' => uniqid('p', true) . '@test.de']));
        static::assertSame(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());

        $body = json_decode($client->getResponse()->getContent(), true);
        static::assertSame('Username is already given', $body['message']);
    }
}
