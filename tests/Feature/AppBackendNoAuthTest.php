<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AppBackendNoAuthTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    private $loginRoute = '/login';
    private $testPwd = '1234', $defaultPwd = 'password';
    private $override = null;

    function __construct() {
        parent::__construct();

        $this->override =  [
            'name' => 'Test user',
            'password' => $this->testPwd
        ];
    }

    private function toArr($factoryModel) {
        return [
            'name' => $factoryModel->name,
            'email' => $factoryModel->email,
            'password' => $factoryModel->password,
            'password_confirmation' => $factoryModel->password_confirmation
        ];
    }

    public function testAddUser() {
        $user = User::factory()->make(array_merge(
            $this->override,
            ['password_confirmation' => $this->testPwd]
        ));
        $response = $this->post(route('user.add'), $this->toArr($user));
        $response->assertStatus(302);
        $response->assertRedirect(route('app.login'))
            ->assertSessionHas('status', 'success')
            ->assertSessionHas('message', 'Registration Successful!');
    }

    public function testAddUserDuplicateEmail() {
        $userInit = User::factory()->create();
        $user = User::factory()->make(array_merge(
            $this->override,
            ['email' => $userInit->email, 'password_confirmation' => $this->testPwd]
        ));
        $response = $this->from(route('app.register'))->post(route('user.add'), $this->toArr($user));
        $response->assertStatus(302);
        $response->assertRedirect(route('app.register'));
        $response->assertSessionHasInput([
            'name' => $user->name,
            'email' => $user->email
        ]);
        $response->assertSessionHasErrors([0, 1]);  /* since errors are normal arrays (not associative) containing 2 errors */
    }

    public function testLoginError() {
        $user = User::factory()->make();
        $response = $this->from(route('app.login'))->post(route('user.authenticate'), [
            'email' => $user->email,
            'password' => 'some-wrong-pwd'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('app.login'));
        $response->assertSessionHasInput([
            'email' => $user->email
        ]);
        $response->assertSessionHasErrors([0]);
    }

    public function testlogin() {
        $user = User::factory()->create();
        $response = $this->post(route('user.authenticate'), [
            'email' => $user->email,
            'password' => $this->defaultPwd  /* default password when generating model from factory */
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('app.home'))
            ->assertSessionHas('status', 'success')
            ->assertSessionHas('message', 'Logged in');
    }
}
