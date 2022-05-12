<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_route_login()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_user_can_login()
    {

        $response = $this->get('/login', [
            'email' => 'carter.nguyen.goldenowl@gmail.com',
            'password' => '12345678',
        ]);

        // $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/');
    }
}