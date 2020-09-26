<?php

namespace App\Http\Resources\Tweet;

use App\Http\Resources\Profile\ProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
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
          'body' => $this->body,
          'profile' => new ProfileResource($this->profile)
        ];
    }
}
