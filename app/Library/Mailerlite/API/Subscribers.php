<?php

namespace App\Library\Mailerlite\API;

use App\Library\Mailerlite\Clients\HttpClient;
use GuzzleHttp\Exception\GuzzleException;

class Subscribers
{
    /**
     * @var HttpClient
     */
    protected $client;
    /**
     * @var null
     */
    private $limit = null;
    /**
     * @var null
     */
    private $offset = null;
    /**
     * @var string
     */
    protected $endpoint = 'subscribers';

    /**
     * @param  HttpClient  $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param $data
     * @return mixed
     * @throws GuzzleException
     */
    public function create($data)
    {
        $response = $this->client->post($this->endpoint, $data);
        return $response['data'];
    }

    /**
     * @param $id
     * @return mixed
     * @throws GuzzleException
     */
    public function find($id)
    {
        $response = $this->client->get($this->endpoint . '/' . $id);
        return $response['data'];
    }

    /**
     * @return mixed
     * @throws GuzzleException
     */
    public function get()
    {
        $params = $this->getParams();
        $response = $this->client->get($this->endpoint, $params);

        return $response['data'];
    }

    /**
     * @param $query
     * @return mixed
     * @throws GuzzleException
     */
    public function search($query)
    {
        $endpoint = $this->endpoint . '/search';
        $params = array_merge($this->getParams(), ['query' => $query]);

        $response = $this->client->get($endpoint, $params);

        return $response['data'];
    }

    /**
     * update a subscriber
     *
     * @return mixed
     * @throws GuzzleException
     */
    public function update($id, $data)
    {
        $response = $this->client->put($this->endpoint . '/' . $id, $data);

        return $response['data'];
    }

    /**
     * delete a subscriber
     *
     * @param $id
     * @return mixed
     * @throws GuzzleException
     */
    public function delete($id)
    {
        $response = $this->client->delete($this->endpoint . '/' . $id);

        return $response['data'];
    }

    /**
     * Get the total count of subscribers
     *
     * @return mixed
     * @throws GuzzleException
     */
    public function totalCount()
    {
        $response = $this->client->get($this->endpoint . '/count');

        return $response['data']->count;
    }

    /**
     * Limit the number of results returned. Will be needed for pagination
     *
     * @param int $limit
     * @return Subscribers
     */
    public function limit(int $limit): Subscribers
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Offset the number of results returned. Will be needed for pagination
     *
     * @param int $offset
     * @return Subscribers
     */
    public function offset(int $offset): Subscribers
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * Get the params for the request with limit and offset
     *
     * @return array
     */
    protected function getParams(): array
    {
        $params = [];

        if (!empty($this->offset)) {
            $params['offset'] = $this->offset;
        }

        if (!empty($this->limit)) {
            $params['limit'] = $this->limit;
        }
        return $params;
    }
}
