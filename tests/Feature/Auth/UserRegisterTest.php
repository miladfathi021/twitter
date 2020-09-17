<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use RefreshDatabase;

    public function userRegisterData()
    {
        return [
            'name' => 'Milad Fathi',
            'email' => 'miladfathi021@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];
    }

    /** @test **/
    public function guest_can_create_new_account()
    {
       $this->withoutExceptionHandling();

       $this->postJson(route('user-register.store'), $this->userRegisterData())
           ->assertStatus(200)
           ->assertJson([
              'data' => [
                  'name' => $this->userRegisterData()['name'],
                  'email' => $this->userRegisterData()['email'],
              ]
           ]);
    }

    /** @test **/
    public function name_is_required()
    {
        $attributes = $this->userRegisterData();
        $attributes['name'] = null;

        $this->postJson(route('user-register.store'), $attributes)
            ->assertStatus(400);
    }

    /** @test **/
    public function name_must_be_string()
    {
        $attributes = $this->userRegisterData();
        $attributes['name'] = 1234;

        $this->postJson(route('user-register.store'), $attributes)
            ->assertStatus(400);
    }

    /** @test **/
    public function name_must_be_greater_than_2_chars()
    {
        $attributes = $this->userRegisterData();
        $attributes['name'] = 'mi';

        $this->postJson(route('user-register.store'), $attributes)
            ->assertStatus(400);
    }

    /** @test **/
    public function name_must_not_be_greater_than_255_chars()
    {
        $attributes = $this->userRegisterData();
        $attributes['name'] = Str::random(256);

        $this->postJson(route('user-register.store'), $attributes)
            ->assertStatus(400);
    }

    /** @test **/
    public function email_is_required()
    {
        $attributes = $this->userRegisterData();
        $attributes['email'] = null;

        $this->postJson(route('user-register.store'), $attributes)
            ->assertStatus(400);
    }

    /** @test **/
    public function email_must_be_a_valid_email_address()
    {
        $attributes = $this->userRegisterData();
        $attributes['email'] = 'miladfathi.com';

        $this->postJson(route('user-register.store'), $attributes)
            ->assertStatus(400);
    }

    /** @test **/
    public function email_must_be_unique()
    {
        $this->postJson(route('user-register.store'), $this->userRegisterData())
            ->assertStatus(200);

        $this->assertDatabaseCount('users', 1);

        $this->postJson(route('user-register.store'), $this->userRegisterData())
            ->assertStatus(400);

        $this->assertDatabaseCount('users', 1);
    }

    /** @test **/
    public function password_is_required()
    {
        $attributes = $this->userRegisterData();
        $attributes['password'] = null;

        $this->postJson(route('user-register.store'), $attributes)
            ->assertStatus(400);
    }

    /** @test **/
    public function password_must_be_string()
    {
        $attributes = $this->userRegisterData();
        $attributes['password'] = 3432;

        $this->postJson(route('user-register.store'), $attributes)
            ->assertStatus(400);
    }

    /** @test **/
    public function password_must_be_greater_than_6_chars()
    {
        $attributes = $this->userRegisterData();
        $attributes['password'] = '12345';

        $this->postJson(route('user-register.store'), $attributes)
            ->assertStatus(400);
    }

    /** @test **/
    public function password_must_not_be_greater_than_50_chars()
    {
        $attributes = $this->userRegisterData();
        $attributes['password'] = Str::random(51);

        $this->postJson(route('user-register.store'), $attributes)
            ->assertStatus(400);
    }

    /** @test **/
    public function password_confirmation_must_be_match()
    {
        $attributes = $this->userRegisterData();
        $attributes['password'] = 'password';
        $attributes['password_confirmation'] = 'pass';

        $this->postJson(route('user-register.store'), $attributes)
            ->assertStatus(400);
    }
}
