<?php

namespace Tests;

use Database\Factories\ProfileFactory;
use Database\Factories\TokenFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn($user = null)
    {
        $this->flushSession();

        if ($user === null) {
            $user = UserFactory::new()->create();
            TokenFactory::new()->create(['user_id' => $user->id]);
            ProfileFactory::new()->create(['user_id' => $user->id]);
        }

        $this->be($user, 'api');

        return $user;
    }
}
