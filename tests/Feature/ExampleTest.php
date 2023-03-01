<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_default_route()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_login()
    {
        $response = $this->get('/');
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
