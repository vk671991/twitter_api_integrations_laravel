<?php
namespace App\Repositories\UserTweets;

interface UserTweetInterface{
    public function insertTweets($data,$username,$twitter_user_id);
    public function getTweets($username,$request);
}
