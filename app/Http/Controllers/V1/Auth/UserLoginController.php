<?php

namespace App\Http\Controllers\V1\Auth;

use App\Exceptions\ValidationException;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\Profile\Profile;
use App\Models\User\User;
use App\useCases\TokenManager;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends ApiController
{
    /**
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthenticationException
     */
    public function store(UserLoginRequest $request)
    {
        $fieldType = filter_var($request->get('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $email = $request->get('username');

        if ($fieldType === 'username') {
            $email = Profile::where('username', $request->get('username'))->first()->owner->email;
        }

        if (!Auth::attempt(['email' => $email, 'password' => $request->get('password')])) {
            throw new AuthenticationException();
        }

        $user = auth()->user();

        $user['api_token'] = TokenManager::new($user)->generate();

        return $this->responseOk(
            new UserResource($user)
        );
    }
}
