<?php

namespace App\Http\Controllers\V1\Auth;

use App\Exceptions\ValidationException;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User\User;
use App\useCases\TokenManager;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends ApiController
{
    /**
     * @param UserLoginRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthenticationException
     */
    public function store(UserLoginRequest $request, User $user)
    {
        $fieldType = filter_var($request->get('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (!Auth::attempt([$fieldType => $request->get('username'), 'password' => $request->get('password')])) {
            throw new AuthenticationException();
        }

        $user = auth()->user();

        $user['api_token'] = TokenManager::new($user)->generate();

        return $this->responseOk(
            new UserResource($user)
        );
    }
}
