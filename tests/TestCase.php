<?php

namespace Tests;

use App\Models\ApiKey;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // this is not a good way to use apiKey like this, I am using this for testing purpose only
    // I will remove this from server after finishing the test
    public $apiKey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiMzU4Mzc3N2NlMWM3YzNkMmY4OGI0MjI5NTU2YWYyMGExM2UxYjJkNWFiM2EwNjMyZmMyMjljZTc2NGZmNGViMTVmYWE4ZDQyZDU3MzM4NWEiLCJpYXQiOjE2ODAwMzgwNzYuMjcwOTg0LCJuYmYiOjE2ODAwMzgwNzYuMjcwOTg4LCJleHAiOjQ4MzU3MTE2NzYuMjY2NDA5LCJzdWIiOiI0MTEyNDIiLCJzY29wZXMiOltdfQ.HvHK9PCD_CYqUOmZNlfG0ZsFdSPkSTJKDkGhAZZXQicX7yM5gQLDBf4gKZIanyrutm_SD8AXV5PjwLy9MUzkdy1-F8V2l77mvOlwvvRMVfv5klrh7_uLrg_sBuCrE6AiubpTbEhrIZsnJshUjVaB4UhXQOOxTueK4DL9Na2HY03W6F3NP825CvlgBD8jmNQFh9VLMl0074Fo_ainQA4M75wyAhKZLzlearUPN7WUxLtISLiRlMgoOUeTy1_8U0oeDaD5-zSwNtBrrBrnC8xDVnRJkCh-oLZVRgNH_y4rYwegnN1ixtQk9ux02AEfhzl7AK75sPbMZUqvTnNPduT_cGHd-Qxa6cjMxx5-J7bHJhdugaC0yMfSa0VQ1r1pJ7veFlHKg3GjbQvZIbcNZKxbCSgnvxTU3Rg_qMVJGGh8-bpqOUBauhlmuyCTIrfjlbM1oHICnYsZTEYu54dyKuW2hi9uaxRzG1k2KS21cAC-Z7aQfjoNApw1wTM5Z3r4RqgnW82pN5PmDy3OosKtHKZfeHugYs4NsmmzYNIW8DHqZY7LbQn2v7AOGwWe-0pyajM0W6crrfspLbRXgpCqcF-wKNbAayeK1N8xS5gNVnsleT58aaxb1-zFX3a72kbPmz4k-rJ9bxVHIC3sC0Opkw8TqEk8ssSNJIbfTTMtFlr6tN0';

    public function setAPiKey()
    {
        ApiKey::updateOrCreate(
            ['name' => 'mailerlite'],
            ['key' => $this->apiKey]
        );
    }
}
