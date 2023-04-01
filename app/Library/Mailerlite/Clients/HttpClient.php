<?php

namespace App\Library\Mailerlite\Clients;

use App\Library\Mailerlite\Concerns\ClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class HttpClient implements ClientInterface
{
    protected $client;
    public $baseUri;
    public $apiKey;

    public function __construct($baseUri, $apiKey)
    {
        $this->baseUri = $baseUri;
        $this->apiKey = $apiKey;
        $this->client = new Client();
    }

    /**
     * @param  string  $endpoint
     * @param  array  $queryString
     * @return array
     * @throws GuzzleException
     */
    public function get(string $endpoint, array $queryString = []): array
    {
        $endpoint = $endpoint.'?'.http_build_query($queryString);

        return $this->request('GET', $endpoint);
    }

    /**
     * @param  string  $endpoint
     * @param  array  $postData
     * @return array
     * @throws GuzzleException
     */
    public function post(string $endpoint, array $postData = []): array
    {
        return $this->request('POST', $endpoint, $postData);
    }

    /**
     * @param  string  $endpoint
     * @param  array  $putData
     * @return array
     * @throws GuzzleException
     */
    public function put(string $endpoint, array $putData = []): array
    {
        return $this->request('PUT', $endpoint, $putData);
    }

    /**
     * @param  string  $endpoint
     * @return array
     * @throws GuzzleException
     */
    public function delete(string $endpoint): array
    {
        return $this->request('DELETE', $endpoint);
    }

    /**
     * Make request to API endpoint.
     *
     * @param  string  $method
     * @param  string  $endpoint
     * @param  array  $options
     * @return array
     * @throws GuzzleException
     */
    protected function request(string $method, string $endpoint, array $options = []): array
    {
        $opt = [];

        if (in_array($method, ['POST', 'PUT'])) {
            $opt['body'] = json_encode($options);
        }

        $opt['headers'] = array_merge([
            'Content-Type' => 'application/json',
            'X-MailerLite-ApiKey' => $this->apiKey,
        ], $options['headers'] ?? []);

        $response = $this->client->request($method, $this->baseUri . $endpoint, $opt);

        return $this->generateResponse($response);
    }

    /**
     * Generate response array to readable and usable format.
     *
     * @param ResponseInterface $response
     * @return array
     */
    public function generateResponse(ResponseInterface $response): array
    {
        $data = (string) $response->getBody();
        $jsonData = json_decode($data, false);

        $responseData = null;
        if ($data && $jsonData) {
            $responseData = $jsonData;
        }

        return [
            'status_code' => $response->getStatusCode(),
            'message' => 'Success - request completed',
            'data' => $responseData
        ];
    }
}
