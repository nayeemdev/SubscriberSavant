<?php

return [

    /*
    |--------------------------------------------------------------------------
    | MailerLite API Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for MailerLite API. Such as API key
    | and API version, which is used to make requests to MailerLite API.
    |
    | To learn more: https://developers.mailerlite.com/
    |
    */

    'api_key' => '', // For now this is not used, because of the requirement is saving the api key in DB
    'base_uri' => 'https://api.mailerlite.com/api/',
    'version' => 'v2',
    'api_key_name' => 'X-MailerLite-ApiKey',
    'subscriber' => [
        'endpoint' => 'subscribers',
        'type' => ['active', 'unsubscribed', 'bounced', 'junk', 'unconfirmed'],
    ],
];
