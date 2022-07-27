<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTweets extends Model
{
    use HasFactory;

    protected $table = 'user_tweets';

    protected $fillable = [
        'twitter_handle', 'twitter_handle_id', 'twitter_id',
        'url', 'text', 'followers_count',
        'friends_count', 'listed_count', 'favourites_count',
        'retweet_count', 'favourite_count', 'favourited',
        'retweeted', 'tweet_created_at'
    ];
}
