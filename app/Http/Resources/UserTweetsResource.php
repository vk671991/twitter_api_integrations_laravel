<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTweetsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->twitter_id,
            'url' => $this->url,
            'full_text' => $this->text,
            'followers_count' => $this->followers_count,
            'friends_count' => $this->friends_count,
            'listed_count' => $this->listed_count,
            'favourites_count' => $this->favourites_count,
            'retweet_count' => $this->retweet_count,
            'favourite_count' => $this->favourite_count,
            'favourited' => $this->favourited,
            'retweeted' => $this->retweeted,
            'tweet_created_at' => $this->tweet_created_at,
        ];
    }
}
