<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Twitter\SearchTweetsCall;

use Abraham\TwitterOAuth\TwitterOAuth;

class PageController extends Controller
{
    protected $query;
    protected $tweet_count;
    protected $includeDate;
    protected $includeDateChecked;

    public function getIndex() {
        return view('index');
    }

    public function postIndex(Request $request) {

        $this->getInputVariables($request);

        $twitterSearchResults = $this->callTwitterSearch();
        $viewVars = array_merge($this->getViewVariables(), ['tweets' => $twitterSearchResults]);
        
        return view('index', $viewVars);
    }

    protected function getInputVariables(Request $request) {
        $this->query = $request->input('query');
        $this->tweetCount = intval($request->input('tweetCount'));
        $this->includeDate = intval($request->input('includeDate'));
        $this->includeDateChecked = $this->includeDate === 1 ? ' checked' : '';
    }

    protected function getViewVariables() {
        return [
            'query' => $this->query,
            'tweetCount' => $this->tweetCount,
            'includeDateChecked' => $this->includeDateChecked
        ];
    }

    protected function setupTwitterConnection() {
        return new TwitterOAuth(
            env('TWITTER_CONSUMER_KEY'),
            env('TWITTER_CONSUMER_SECRET'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET')
        );
    }

    protected function callTwitterSearch() {
        $twitterConnection = $this->setupTwitterConnection();

        $apiCall = new SearchTweetsCall($twitterConnection);
        $apiCall->setup($this->query);
        
        return $apiCall->call();
    }
}
