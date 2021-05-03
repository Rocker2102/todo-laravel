<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppBackendNoAuthTest extends TestCase
{
    use withFaker;

    private $loginRoute = '/login';
    protected static $user = null;

    public function setUp():void {
        parent::setUp();
        if (!static::$user) {
            static::$user = [
                'name' => $this->faker->name(),
                'email' => $this->faker->email(),
                'password' => '1234',
                'password_confirmation' => '1234'
            ];
        }
    }

    public function testAddUser() {
        $response = $this->post(route('user.add'), static::$user);
        $response->assertStatus(302);
        $response->assertRedirect(route('app.login'))
            ->assertSessionHas('status', 'success')
            ->assertSessionHas('message', 'Registration Successful!');
    }

    public function testAddUserDuplicateEmail() {
        $response = $this->from(route('app.register'))->post(route('user.add'), static::$user);
        $response->assertStatus(302);
        $response->assertRedirect(route('app.register'));
        $response->assertSessionHasInput([
            'name' => static::$user['name'],
            'email' => static::$user['email']
        ]);
        $response->assertSessionHasErrors([0, 1]);  /* since errors are normal arrays (not associative) containing 2 errors */
    }

    public function testLoginError() {
        $response = $this->from(route('app.login'))->post(route('user.authenticate'), [
            'email' => static::$user['email'],
            'password' => 'some-wrong-pwd'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('app.login'));
        $response->assertSessionHasInput([
            'email' => static::$user['email']
        ]);
        $response->assertSessionHasErrors([0]);
    }

    public function testlogin() {
        $response = $this->post(route('user.authenticate'), static::$user);
        $response->assertStatus(302);
        $response->assertRedirect(route('app.home'))
            ->assertSessionHas('status', 'success')
            ->assertSessionHas('message', 'Logged in');
    }
}
