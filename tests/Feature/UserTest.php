<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserTest extends TestCase
{
    private $username;
    protected function setUp(): void
    {
        parent::setUp();
        $this->username = 'TestUser001';
        $this->email = 'TestUser001@example.com';
        $this->password = 'password';
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function test_register()
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);

        $this->post(route('register'), [
            'name' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password,
            'rule-privacy' => 'yes',
        ]);
        $this->assertAuthenticatedAs(User::where('name',$this->username)->first());
    }

    public function test_login()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);

        $this->post(route('login'), [
            'email' => $this->email,
            'password' => $this->password,
        ]);
        $this->assertAuthenticatedAs(User::where('name',$this->username)->first());
    }

    public function test_logout()
    {
        $this->actingAs(User::where('name',$this->username)->first())->assertAuthenticated();
        $this->post(route('logout'));
        $this->assertGuest();
    }

    public function test_account_delete()
    {
        $this->actingAs(User::where('name',$this->username)->first())->assertAuthenticated();

        $response = $this->get(route('users.leave',['display_id' => Auth::user()->display_id]));
        $response->assertStatus(200);

        $this->delete(route('users.destroy',['user' => Auth::id()]), [
            'delete_accept' => 'yes',
        ]);
        $this->assertDatabaseMissing('users', ['name' => $this->username]);
    }
}
