<?php

namespace App\Http\Controllers\V1\Person;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\Profile\Profile;

class PersonController extends ApiController
{
    public function index($username)
    {
        $person = Profile::where('username', $username)->firstOrFail();

        return $this->responseOk(
            new ProfileResource($person)
        );
    }
}
