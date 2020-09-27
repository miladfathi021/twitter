<?php

namespace App\Providers;

use App\Models\Tweet\Tweet;
use App\Policies\Tweet\TweetPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         Tweet::class => TweetPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Auth::viaRequest('api_token', function ($request) {
//            return User::where('api_token', $request->token)->first();
//            dd('dd');
//        });
    }
}
