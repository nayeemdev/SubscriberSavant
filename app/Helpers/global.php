<?php

/**
 * @param string $name
 * @return string|null
 */
if (! function_exists('getApiKey')) {
    function getApiKey($name): ?string
    {
        // TODO: api key should be cached for better performance without db query
        // TODO: api key should be encrypted
        $api = \App\Models\ApiKey::where('name', $name)->first();
        return $api->key ?? null;
    }
}
