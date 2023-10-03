<?php

namespace Tests\Unit\Services;

use App\Services\GsmCallService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GsmCallServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_sends_gsm_call_request()
    {
        // Mock the Guzzle client with a predefined response
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode([
                'result' => 'success'
            ])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $gsmCallService = new GsmCallService();

        // Call the sendRequest method
        $response = $gsmCallService->sendRequest($client, 12345678, '123456789', '987654321');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
