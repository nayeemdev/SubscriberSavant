<?php

namespace App\Library\Mailerlite;

use App\Library\Mailerlite\API\Authentication;
use App\Library\Mailerlite\API\Subscribers;
use App\Library\Mailerlite\Clients\HttpClient;
use GuzzleHttp\Client;

class Mailerlite
{
    protected $client;
    protected $apiKey;
    protected $baseUri;

    public function __construct(string $apiKey, Client $httpClient = null)
    {
        $this->apiKey = $apiKey;
        $uri = config('library.mailerlite.base_uri');
        $version = config('library.mailerlite.version');
        $this->baseUri = $uri . $version . '/';
        $this->client = new HttpClient(
            $this->baseUri,
            $this->apiKey,
            $httpClient ?? new Client()
        );
    }

    /**
     * Access to authentication API.
     *
     * @return Authentication
     */
    public function authentication(): Authentication
    {
        return new Authentication($this->client);
    }

    /**
     * Access to subscribers API.
     *
     * @return Subscribers
     */
    public function subscribers(): Subscribers
    {
        return new Subscribers($this->client);
    }
}
