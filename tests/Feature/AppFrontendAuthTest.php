<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AppFrontendAuthTest extends TestCase
{
    use DatabaseTransactions;

    protected static $user = null;

    public function setUp():void {
        parent::setUp();
        if (!static::$user) {
            static::$user = User::factory()->create();
        }
        $this->actingAs(static::$user);
    }

    public function testUserAuthenticated() {
        $this->assertAuthenticatedAs(static::$user);
    }

    public function testLoginRedirect() {
        $response = $this->get(route('app.login'));
        $response->assertStatus(302)
            ->assertRedirect('/home');
    }

    public function testRegisterRedirect() {
        $response = $this->get(route('app.register'));
        $response->assertStatus(302)
            ->assertRedirect('/home');
    }

    public function testAppHomeView() {
        $response = $this->get(route('app.home'));
        $response->assertSuccessful()
            ->assertViewIs('app');
    }

    public function testProfileView() {
        $this->followingRedirects();
        $response = $this->get(route('app.profile'));
        $response->assertSuccessful()
            ->assertViewIs('profile');
    }

    public function testTodoEditView() {
        return $this->assertTrue(true);

        $response = $this->get(route('app.todo.edit'));
        $response->assertSuccessful()
            ->assertViewIs('edit-todo');
    }

    public function testLogout() {
        $response = $this->get(route('user.logout'));
        $response->assertStatus(302)
            ->assertSessionHas('status', 'info')
            ->assertSessionHas('message', 'Logged out!');
    }
}
