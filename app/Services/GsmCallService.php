<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class GsmCallService
{
    /**
     * @param Client $client
     * @param $call_id
     * @param $caller_phonenumber
     * @param $callee_phonenumber
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function sendRequest(Client $client, $call_id, $caller_phonenumber, $callee_phonenumber): ResponseInterface
    {
        return $client->post(env("CALL_API_URL"), [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'type' => 'bulk',
                'mute' => 'no',
                'room_number' => $call_id,
                'session_file_name' => $call_id,
                'participant' => "{$caller_phonenumber},{$callee_phonenumber}"
            ],
            'verify' => false
        ]);
    }
}
