<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppFrontendNoAuthTest extends TestCase
{
    private $loginRoute = '/login';

    public function testHome()
    {
        $response = $this->get('/home');
        $response->assertStatus(301)
            ->assertRedirect('/app');
    }

    public function testAppHomeRedirect() {
        $response = $this->get(route('app.home'));
        $response->assertStatus(302)
            ->assertRedirect($this->loginRoute);
    }

    public function testLoginRedirect() {
        $response = $this->get($this->loginRoute);
        $response->assertStatus(302)
            ->assertRedirect(route('app.login'));
    }

    public function testLogoutRedirect() {
        $response = $this->get(route('user.logout'));
        $response->assertStatus(302)
            ->assertRedirect($this->loginRoute);
    }

    public function testRegisterRedirect() {
        $response = $this->get('/register');
        $response->assertStatus(302)
            ->assertRedirect(route('app.register'));
    }

    public function testProfileRedirect() {
        $response = $this->get(route('app.profile'));
        $response->assertStatus(302)
            ->assertRedirect(route('user.profile'));
    }

    public function testLoginView() {
        $this->followingRedirects();
        $response = $this->get(route('login'));
        $response->assertStatus(200)
            ->assertViewIs('login');
    }

    public function testRegisterView() {
        $response = $this->get(route('app.register'));
        $response->assertStatus(200)
            ->assertViewIs('register');
    }

    public function testTodoEditView() {
        $this->followingRedirects();
        $response = $this->get(route('app.todo.edit'));
        $response->assertStatus(200)
            ->assertViewIs('login');
    }
}
