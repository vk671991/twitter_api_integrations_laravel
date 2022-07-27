<?php
return [
    'consumer_key' => env('TWITTER_CONSUMER_KEY'),
    'consumer_secret' => env('TWITTER_CONSUMER_SECRET'),
    'access_token' => env('TWITTER_ACCESS_TOKEN'),
    'access_secret' => env('TWITTER_ACCESS_TOKEN_SECRET'),
    'bearer_token' => env('TWITTER_BEARER_TOKEN'),
    'get_user_details_url' => env('TWITTER_GET_USER_DETAILS_API'),
    'get_user_tweets_url' => env('TWITTER_GET_USER_TWEETS_API'),
];
