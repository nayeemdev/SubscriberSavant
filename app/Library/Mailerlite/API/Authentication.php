<?php

namespace App\Library\Mailerlite\API;

use App\Library\Mailerlite\Clients\HttpClient;
use GuzzleHttp\Exception\GuzzleException;

class Authentication
{
    /**
     * @var HttpClient
     */
    protected $client;
    /**
     * @var string
     */
    protected $endpoint = 'me';

    /**
     * @param  HttpClient  $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return bool
     * @throws GuzzleException
     */
    public function check(): bool
    {
        $response = $this->client->get($this->endpoint);

        return $response['status_code'] === 200;
    }
}
