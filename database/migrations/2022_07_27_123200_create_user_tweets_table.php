<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tweets', function (Blueprint $table) {
            $table->id();
            $table->string('twitter_handle');
            $table->bigInteger('twitter_handle_id');
            $table->bigInteger('twitter_id');
            $table->string('url');
            $table->longText('text');
            $table->bigInteger('followers_count')->default(0);
            $table->bigInteger('friends_count')->default(0);
            $table->bigInteger('listed_count')->default(0);
            $table->bigInteger('favourites_count')->default(0);
            $table->bigInteger('retweet_count')->default(0);
            $table->bigInteger('favourite_count')->default(0);
            $table->bigInteger('favourited')->default(false);
            $table->bigInteger('retweeted')->default(false);
            $table->string('tweet_created_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tweets');
    }
}
