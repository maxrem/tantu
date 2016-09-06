<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Twitter\SearchTweetsCall;

use Abraham\TwitterOAuth\TwitterOAuth;

class ApiTwitterController extends Controller
{
    public function searchTweets($q, $count = null) {

        $twitterConn = new TwitterOAuth(
            env('TWITTER_CONSUMER_KEY'),
            env('TWITTER_CONSUMER_SECRET'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET')
        );

        $apiCall = new SearchTweetsCall($twitterConn);
        $apiCall->setup($q, $count);
        
        return $apiCall->call();
    }
}
