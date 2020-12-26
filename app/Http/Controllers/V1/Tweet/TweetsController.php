<?php

namespace App\Http\Controllers\V1\Tweet;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Tweet\TweetRequest;
use App\Http\Requests\Tweet\TweetUpdateRequest;
use App\Http\Resources\Tweet\TweetCollection;
use App\Http\Resources\Tweet\TweetResource;
use App\Models\Tweet\Tweet;

class TweetsController extends ApiController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tweets = auth()->user()
            ->profile
            ->tweets()
            ->with('profile')
            ->orderby('created_at', 'desc')
            ->paginate(25);

        return $this->responseOk(
            new TweetCollection($tweets)
        );
    }

    /**
     * @param Tweet $tweet
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Tweet $tweet)
    {
        return $this->responseOk(
            new TweetResource($tweet)
        );
    }

    /**
     * @param TweetRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TweetRequest $request)
    {
        $tweet = auth()->user()->profile->tweets()->create($request->all());

        return $this->responseOk(
            new TweetResource($tweet)
        );
    }

    /**
     * @param Tweet $tweet
     * @param TweetUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Tweet $tweet, TweetUpdateRequest $request)
    {
        $tweet->update($request->all());

        return $this->responseOk(
            new TweetResource($tweet->fresh())
        );
    }

    /**
     * @param Tweet $tweet
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Tweet $tweet)
    {
        $tweet->delete();

        return $this->responseOk();
    }
}
