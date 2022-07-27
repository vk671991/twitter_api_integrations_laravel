<?php

namespace App\Repositories\UserTweets;

use Illuminate\Support\ServiceProvider;

class UserTweetsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Repositories\UserTweets\UserTweetInterface', 'App\Repositories\UserTweets\UserTweetsRepository');
    }
}
