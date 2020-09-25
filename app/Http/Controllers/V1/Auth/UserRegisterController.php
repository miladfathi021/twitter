<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User\User;
use App\useCases\ProfileManager;
use App\useCases\TokenManager;
use App\useCases\Username;
use Illuminate\Support\Facades\Auth;

class UserRegisterController extends ApiController
{
    /**
     * @param UserRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRegisterRequest $request)
    {
        $user = User::create($request->all());

        Auth::login($user);

        // Add Username and Create Profile
        ProfileManager::new($request)->addUsername()->create();

        // Create Api Token
        $user['api_token'] = TokenManager::new($user)->generate();

        return $this->responseOk(
            new UserResource($user)
        );
    }
}
