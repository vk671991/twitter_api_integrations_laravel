<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\TwitterUtility;
use App\Repositories\UserTweets\UserTweetInterface as UserTweetInterface;
use App\Http\Resources\UserTweetsResource as UserTweetsResource;

class TwitterController extends Controller
{
    public function __construct(UserTweetInterface $user_tweets)
    {
        $this->user_tweets = $user_tweets;
    }

    /* -----------------------------------------------------------------------------------------
      @Description: Get Tweets API by provided twitter handle
      @input: username -> twitter handle and request to get URL parameters
      @Output: status true or false, message successful or error and data tweets
      -------------------------------------------------------------------------------------------- */
    public function getTweets($username, Request $request)
    {
        try{
            if($username){
                $check_user = TwitterUtility::checkTwitterHandle($username);
                if($check_user['status']==true){
                    $twitter_user_id = $check_user['data']->id;
                    $get_tweets_from_api = TwitterUtility::getTweets($twitter_user_id);
                    if($get_tweets_from_api['status']==true){
                        $insert_tweets=$this->user_tweets->insertTweets($get_tweets_from_api['data'],$username,$twitter_user_id);
                        if($insert_tweets){
                            $get_tweets_from_db = $this->user_tweets->getTweets($username,$request);
                            return response()->json(['status' => false ,' message' => 'Tweets Loaded.', 'data' => UserTweetsResource::collection($get_tweets_from_db)],401);
                        }
                        return response()->json(['status' => false ,' message' => 'Unable to insert tweets into DB.'],401);
                    }
                    return response()->json(['status' => false ,' message' => $get_tweets_from_api['message']],401);

                }
                return response()->json(['status' => false ,' message' => $check_user['message']],401);
            }
            return response()->json(['status' => false ,' message' => 'Please provide twitter handle.'],400);
        }
        catch (\Exception $e) {
            return response()->json(['status' => false ,' message' => $e->getMessage()],500);
        }

    }
}
