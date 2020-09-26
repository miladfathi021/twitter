<?php

namespace Tests\Feature\Tweet;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class TweetTest extends TestCase
{
    use RefreshDatabase;

    public function tweetData()
    {
        return [
            'body' => 'Lorem ipsum, or lipsum as it is sometimes known.'
        ];
    }

    /** @test **/
    public function The_guest_can_not_create_new_tweet()
    {
        $this->postJson(route('tweets.store'), $this->tweetData())
            ->assertStatus(401);
    }

    /** @test **/
    public function The_authorized_user_can_create_a_new_tweet()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $this->postJson(route('tweets.store'), $this->tweetData())
            ->assertStatus(200);

        $this->assertDatabaseHas('tweets', [
            'body' => $this->tweetData()['body'],
            'profile_id' => auth()->user()->profile->id,
        ]);
    }

    /** @test **/
    public function body_is_required()
    {
        $this->signIn();

        $data = [
            'body' => null,
        ];

        $this->postJson(route('tweets.store'), $data)
            ->assertStatus(400);
    }

    /** @test **/
    public function body_must_be_string ()
    {
        $this->signIn();

        $data = [
            'body' => 123,
        ];

        $this->postJson(route('tweets.store'), $data)
            ->assertStatus(400);
    }

    /** @test **/
    public function body_must_be_greater_than_2_chars()
    {
        $this->signIn();

        $data = [
            'body' => 'M',
        ];

        $this->postJson(route('tweets.store'), $data)
            ->assertStatus(400);
    }

    /** @test **/
    public function body_must_not_be_greater_than_255_chars()
    {
        $this->signIn();

        $data = [
            'body' => Str::random(256),
        ];

        $this->postJson(route('tweets.store'), $data)
            ->assertStatus(400);
    }
}
