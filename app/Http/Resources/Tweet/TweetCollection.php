<?php

namespace App\Http\Resources\Tweet;

use App\Http\Resources\ApiResourceCollection;

class TweetCollection extends ApiResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'list' => TweetResource::collection($this->collection),
            'pagination' => $this->pagination()
        ];
    }
}
