<?php

namespace Tests\Unit;

use App\Library\Mailerlite\Mailerlite;
use GuzzleHttp\Exception\GuzzleException;
use Tests\TestCase;

class SubscribersTest extends TestCase
{
    public $mailerlite;
    public $subscriberApi;
    public $demoSubscriber;

    public function setUp(): void
    {
        parent::setUp();

        $this->mailerlite = new MailerLite($this->apiKey);
        $this->subscriberApi = $this->mailerlite->subscribers();
        $this->demoSubscriber = $this->subscriberApi->create([
            'email' => 'test@test-test.test',
            'name' => 'Test Test',
            'fields' => [
                'country' => 'Test Country',
            ],
        ]);
    }

    public function tearDown(): void
    {
        parent::tearDown();

//        $this->subscriberApi->delete($this->demoSubscriber->id);
    }

    public function test_create_subscriber_without_api_key_will_unauthorized()
    {
        $apiKey = 'DummyApiKey';
        $mailerlite = new MailerLite($apiKey);
        $this->expectException(GuzzleException::class);
        $mailerlite->subscribers()->get();
    }

    public function test_create_subscriber()
    {
        $response = $this->subscriberApi->create([
            'email' => 'test@test-test.test',
            'name' => 'Test Test',
            'fields' => [
                'country' => 'Test Country',
            ],
        ]);

        $this->assertEquals($this->demoSubscriber->email, $response->email);
    }

    public function test_find_subscriber()
    {
        $response = $this->subscriberApi->find($this->demoSubscriber->id);

        $this->assertEquals($this->demoSubscriber->email, $response->email);
    }

    public function test_get_subscribers()
    {
        $response = $this->subscriberApi->get();

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    public function test_get_subscribers_with_limit()
    {
        $limit = 1;
        $response = $this->subscriberApi->limit($limit)->get();

        $this->assertIsArray($response);
        $this->assertCount($limit, $response);
    }

    public function test_get_subscribers_with_offset()
    {
        $offset = 1;
        $response = $this->subscriberApi->offset($offset)->get();

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    public function test_get_subscribers_with_limit_and_offset()
    {
        $limit = 1;
        $offset = 1;
        $response = $this->subscriberApi->limit($limit)->offset($offset)->get();

        $this->assertIsArray($response);
        $this->assertCount($limit, $response);
    }

    public function test_update_subscriber()
    {
        $response = $this->subscriberApi->update($this->demoSubscriber->id, [
            'name' => 'Test Test Updated',
            'fields' => [
                'country' => 'Test Country Updated',
            ],
        ]);

        $this->assertEquals('Test Test Updated', $response->name);
        $this->assertEquals('Test Country Updated', collect($response->fields)->where('key', 'country')->first()->value);
    }

    public function test_delete_subscriber()
    {
        $response = $this->subscriberApi->delete($this->demoSubscriber->id);

        $this->assertNull($response);
    }
}
