<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
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

    public function test_user_login_susscess()
    {
        $response = $this->post('/login', [
            'email' => 'hung@gmail.com', // email, password already exists in db
            'password' => '12345678',
        ]);
        $response->assertRedirect('/');
        $this->assertEquals(true, Auth::check());
    }

    public function test_user_login_fail()
    {
        $response = $this->post('/login', [
            'email' => 'hung@gmail.com',
            'password' => '123', // test case sai password
        ]);

        $this->assertEquals(false, Auth::check());
    }
}
