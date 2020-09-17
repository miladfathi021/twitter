<?php


namespace App\useCases;


use App\Models\Auth\ApiToken;
use Illuminate\Support\Str;

class TokenManager
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public static function new($user)
    {
        return new static($user);
    }

    public function generate()
    {
        $token = Str::uuid();

        return $this->user->apiTokens()->create([
            'token' => $token
        ]);
    }
}
