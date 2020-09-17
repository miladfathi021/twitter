<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User\User;
use App\useCases\TokenManager;
use App\useCases\Username;
use Illuminate\Support\Facades\Auth;

class UserRegisterController extends ApiController
{
    public function store(UserRegisterRequest $request)
    {
        // Create Username
        $attributes = Username::new($request->all())->generate();

        $user = User::create($attributes);

        // Create Api Token
        $user['api_token'] = TokenManager::new($user)->generate();

        Auth::login($user);

        return $this->responseOk(
            new UserResource($user)
        );
    }
}
