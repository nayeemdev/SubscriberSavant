<?php

namespace Tests\Feature;

use App\Models\ApiKey;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $connection = 'mysql';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_root_url_should_redirect()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function test_subscription_wont_work_without_api_key()
    {
        ApiKey::where('name', 'mailerlite')->delete();

        $response = $this->get('/subscribers');
        $response->assertStatus(302);
        $response->assertSessionHas('error');
        $this->assertEquals('API key is not set.', $response->getSession()->get('error'));
    }

    public function test_subscription_will_work_with_api_key()
    {
        ApiKey::updateOrCreate(
            ['name' => 'mailerlite'],
            ['key' => 'test']
        );
        $response = $this->get('/subscribers');
        $response->assertStatus(200);
    }

    public function test_user_can_see_api_integration_page()
    {
        $response = $this->get(route('integration.show'));

        $response->assertStatus(200);
        $response->assertSee('API Key');
        $response->assertViewIs('api-integration.validate');
    }

    public function test_user_can_see_api_key_in_api_integration_page()
    {
        $this->setAPiKey();
        $response = $this->get(route('integration.show'));

        $this->assertDatabaseHas('api_keys', [
            'name' => 'mailerlite',
            'key' => $this->apiKey,
        ]);

        $response->assertStatus(200);
        $response->assertSee($this->apiKey);
    }

    public function test_user_can_validate_save_api_key()
    {
        $response = $this->post(route('integration.validate'), [
            'api_key' => $this->apiKey,
        ]);

        $this->assertDatabaseHas('api_keys', [
            'name' => 'mailerlite',
            'key' => $this->apiKey,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $this->assertEquals('Key is valid and ready to use. You can subscribe to the newsletter.', $response->getSession()->get('success'));
    }

    public function test_user_can_not_validate_save_api_key_with_invalid_key()
    {
        $response = $this->post(route('integration.validate'), [
            'api_key' => 'invalid_key',
        ]);

        $this->assertDatabaseMissing('api_keys', [
            'name' => 'mailerlite',
            'key' => 'invalid_key',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('error');
        $this->assertEquals('API key is not valid.', $response->getSession()->get('error'));
    }

    public function test_user_can_see_subscribers_page()
    {
        $this->setAPiKey();
        $response = $this->get(route('subscribers.index'));

        $response->assertStatus(200);
        $response->assertSee('Subscribers');
        $response->assertViewIs('subscribers.index');
    }

    public function test_user_can_subscribe_page_with_form()
    {
        $this->setAPiKey();
        $response = $this->get(route('subscribers.create'));

        $response->assertStatus(200);
        $response->assertSee('Subscribe');
        $response->assertViewIs('subscribers.create');
    }

    public function test_user_can_subscribe_with_valid_data()
    {
        $this->setAPiKey();
        $data = [
            'email' => 'test@test-test.test',
            'name' => 'Test Test',
            'country' => 'Bangladesh',
        ];

        $response = $this->post(route('subscribers.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('subscribers', [
            'email' => $data['email']
        ]);
        $this->assertEquals('Subscriber created successfully.', $response->getSession()->get('success'));
    }

    public function test_user_can_not_subscribe_with_invalid_data()
    {
        $this->setAPiKey();
        $data = [
            'email' => 'test@test-test.test',
            'name' => 'Test Test',
            'country' => 'test',
        ];

        $response = $this->post(route('subscribers.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['country']);
        $response->assertSessionHasErrors(['country' => 'The country is not valid.']);
    }

    public function test_user_can_not_subscribe_with_invalid_email()
    {
        $this->setAPiKey();
        $data = [
            'email' => 'test',
            'name' => 'Test Test',
            'country' => 'Bangladesh',
        ];

        $response = $this->post(route('subscribers.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
        $response->assertSessionHasErrors(['email' => 'The email must be a valid email address.']);
    }

    public function test_user_can_update_subscriber()
    {
        $this->setAPiKey();
        $data = [
            'email' => 'test@test-test.test',
            'name' => 'Test Test',
            'country' => 'Bangladesh',
        ];

        $this->post(route('subscribers.store'), $data);

        $data['name'] = 'Test Test 2';

        $subscriber_id = \App\Models\Subscriber::first()->subscriber_id;

        $response = $this->put(route('subscribers.update', $subscriber_id), $data);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $this->assertEquals('Subscriber updated successfully.', $response->getSession()->get('success'));
    }

    public function test_user_can_delete_subscriber()
    {
        $this->setAPiKey();
        $data = [
            'email' => 'test@test-test.test',
            'name' => 'Test Test',
            'country' => 'Bangladesh',
        ];
        $this->post(route('subscribers.store'), $data);

        $subscriber_id = \App\Models\Subscriber::first()->subscriber_id;

        $response = $this->delete(route('subscribers.destroy', $subscriber_id));

        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'message' => 'Subscriber deleted successfully.']);
        $response->assertJsonStructure(['success', 'message']);
        $this->assertDatabaseMissing('subscribers', [
            'email' => $data['email']
        ]);
    }
}
