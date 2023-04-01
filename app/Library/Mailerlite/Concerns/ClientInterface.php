<?php

namespace App\Library\Mailerlite\Concerns;

interface ClientInterface
{
    public function get(string $endpoint, array $queryString = []): array;

    public function post(string $endpoint, array $postData = []): array;

    public function put(string $endpoint, array $putData = []): array;

    public function delete(string $endpoint): array;
}
