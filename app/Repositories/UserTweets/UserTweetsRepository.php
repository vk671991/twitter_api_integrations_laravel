<?php
namespace App\Repositories\UserTweets;

use App\Repositories\UserTweets\UserTweetInterface as UserTweetInterface;
use App\Models\UserTweets;
use DB;

class UserTweetsRepository implements UserTweetInterface
{
    public $user_tweets;

    function __construct(UserTweets $user_tweets) {
        $this->user_tweets = $user_tweets;
    }

    public function insertTweets($data,$username,$twitter_user_id)
    {
        try{
            DB::beginTransaction();
            foreach ($data as $key => $value){
                $check = $this->user_tweets->where([
                    'twitter_handle' => $username,
                    'twitter_handle_id'  => $twitter_user_id,
                    'twitter_id'   => $value->id
                ])->first();
                if($check != null ){
                    $check->update([
                        'url' => (property_exists($value->entities,'urls')) ? $value->entities->urls[0]->url : 'NA',
                        'text' => $value->text,
                        'followers_count' => 0,
                        'friends_count' => 0,
                        'listed_count' => 0,
                        'favourites_count' => 0,
                        'retweet_count' => 0,
                        'favourite_count' => 0,
                        'favourited' => 0,
                        'retweeted' => 0,
                        'tweet_created_at' => $value->created_at,
                    ]);
                }
                else{
                    $this->user_tweets->create([
                        'twitter_handle' => $username,
                        'twitter_handle_id'  => $twitter_user_id,
                        'twitter_id'   => $value->id,
                        'url' => (property_exists($value->entities,'urls')) ? $value->entities->urls[0]->url : 'NA',
                        'text' => $value->text,
                        'followers_count' => 0,
                        'friends_count' => 0,
                        'listed_count' => 0,
                        'favourites_count' => 0,
                        'retweet_count' => 0,
                        'favourite_count' => 0,
                        'favourited' => 0,
                        'retweeted' => 0,
                        'tweet_created_at' => $value->created_at,
                    ]);
                }
            }
            DB::commit();
            return true;
        }
        catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function getTweets($username,$request)
    {
        try{
            $tweets = $this->user_tweets->select('twitter_id','url','text','followers_count','friends_count','listed_count','favourites_count',
            'retweet_count','favourite_count','favourited','retweeted','tweet_created_at');
            if($request->order_by == 'DESC'){
                $tweets->orderBy('twitter_id','DESC');
            }
            else{
                $tweets->orderBy('twitter_id');
            }
            return $tweets->get();

        }
        catch (\Exception $e) {
            return false;
        }
    }

}
