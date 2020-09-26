<?php

namespace App\Http\Controllers\V1\Tweet;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Tweet\TweetRequest;
use App\Http\Resources\Tweet\TweetResource;

class TweetsController extends ApiController
{
    public function store(TweetRequest $request)
    {
        $tweet = auth()->user()->profile->tweets()->create($request->all());

        return $this->responseOk(
            new TweetResource($tweet)
        );
    }
}
