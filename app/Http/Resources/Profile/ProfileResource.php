<?php

namespace App\Http\Resources\Profile;

use App\Http\Resources\Tweet\TweetCollection;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->owner),
            'username' => $this->username,
            'tweets' => new TweetCollection($this->tweets()->paginate(25))
        ];
    }
}
