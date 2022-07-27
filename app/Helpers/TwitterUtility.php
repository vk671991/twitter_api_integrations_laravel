<?php

namespace App\Helpers;

use GuzzleHttp\Client as GuzzleClient;

class TwitterUtility
{
    /**
     * @var string
     */
    private $access_token;

    /**
     * @var string
     */
    private $access_token_secret;

    /**
     * @var string
     */
    private $consumer_key;

    /**
     * @var string
     */
    private $consumer_secret;

    /**
     * @var string
     */
    private $bearer_token;


    public function __construct()
    {
        $this->access_token = config('twitter.access_token');
        $this->access_token_secret = config('twitter.access_secret');
        $this->consumer_key = config('twitter.consumer_key');
        $this->consumer_secret = config('twitter.consumer_secret');
        $this->bearer_token = config('twitter.bearer_token');
    }

    /* -----------------------------------------------------------------------------------------
      @Description: checks provided twitter username  exist of not
      @input: username
      @Output: status true or false, message successful or error and data response from the twitter API
      -------------------------------------------------------------------------------------------- */
    public function checkTwitterHandle($username)
    {
        try{
                if($username){
                    $check_twitter_handle = self::curlCall( config('twitter.get_user_details_url').$username);
                    return $check_twitter_handle;
                }
                return [
                    'status' => true,
                    'message' => 'Please provide twitter username'
                ];
        }
        catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /* -----------------------------------------------------------------------------------------
      @Description: checks provided twitter username  exist of not
      @input: username
      @Output: status true or false, message successful or error and data response from the twitter API
      -------------------------------------------------------------------------------------------- */
    public function getTweets($id)
    {
        try{
            if($id){
                $get_tweets = self::curlCall( config('twitter.get_user_tweets_url').$id.'/tweets?tweet.fields=created_at,entities,text');
                return $get_tweets;
            }
            return [
                'status' => false,
                'message' => 'Please provide twitter id'
            ];
        }
        catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /* -----------------------------------------------------------------------------------------
      @Description: Twitter API calls
      @input: url
      @Output: status true or false, message successful or error and data response from the twitter API
      -------------------------------------------------------------------------------------------- */
    public function curlCall($url){
        try{

            $bearer_token        = (new static)->bearer_token;
            $headers = [
                'Content-Type' => 'application/json',
                'AccessToken' => 'key',
                'Authorization' => 'Bearer '.$bearer_token,
            ];
            $client = new GuzzleClient([
                'headers' => $headers
            ]);
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody()->getContents());

            if(isset($data->errors)){
                return [
                    'status' => false,
                    'message' => $data->errors[0]->detail
                ];
            }
            if($response->getStatusCode() == 200){
                return [
                    'status' => true,
                    'message' => 'User found.',
                    'data' => $data->data
                ];
            }
            return [
                'status' => false,
                'message' => 'Something went wrong with Twitter API'
            ];

        }
        catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage() .' at '.$e->getLine()
            ];
        }
    }
}
