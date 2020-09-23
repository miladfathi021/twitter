<?php

namespace Tests\Feature\Auth;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    public function userLoginData()
    {
        return [
            'username' => 'miladfathi021@gmail.com',
            'password' => 'password',
        ];
    }

    /** @test **/
    public function user_can_login_to_account_by_email()
    {
        $this->withoutExceptionHandling();

        UserFactory::new()->create(['email' => $this->userLoginData()['username']]);

        $this->postJson(route('user-login.store'), $this->userLoginData())
            ->assertStatus(200)
            ->assertJson([
               'data' => [
                   'email' =>  $this->userLoginData()['username'],
               ]
            ]);
    }

    /** @test **/
    public function user_can_login_to_account_by_username()
    {
        $this->withoutExceptionHandling();

        $attributes = $this->userLoginData();
        $attributes['username'] = 'miladfathi021';

        UserFactory::new()->create(['username' => $attributes['username']]);

        $this->postJson(route('user-login.store'), $attributes)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'username' =>  $attributes['username']
                ]
            ]);
    }

    /** @test **/
    public function username_is_required()
    {
        UserFactory::new()->create(['email' => $this->userLoginData()['username']]);

        $attributes = $this->userLoginData();
        $attributes['username'] = null;

        $this->postJson(route('user-login.store'), $attributes)
            ->assertStatus(400);
    }

    /** @test **/
    public function password_is_required()
    {
        UserFactory::new()->create(['email' => $this->userLoginData()['username']]);

        $attributes = $this->userLoginData();
        $attributes['password'] = null;

        $this->postJson(route('user-login.store'), $attributes)
            ->assertStatus(400);
    }

    /** @test **/
    public function username_must_be_exists_in_users_table()
    {
        $this->postJson(route('user-login.store'), $this->userLoginData())
            ->assertStatus(400);
    }
}
