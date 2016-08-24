<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Twitter\SearchTweetsCall;

use Abraham\TwitterOAuth\TwitterOAuth;

class PageController extends Controller
{
    protected $query;
    protected $tweetCount;
    protected $includeDate;
    protected $includeDateChecked;

    function __construct() {
        $this->query = '';
        $this->tweetCount = 20;
        $this->includeDate = -1;
        $this->includeDateChecked = '';
    }

    public function getIndex() {
        $viewVars = $this->getViewVariables();
        return view('index', $viewVars);
    }

    public function postIndex(Request $request) {

        $this->getInputVariables($request);

        $twitterSearchResults = $this->callTwitterSearch();

        $viewVars = $this->getViewVariables($twitterSearchResults);
        
        return view('index', $viewVars);
    }

    protected function getInputVariables(Request $request) {
        $this->query = $request->input('query');
        $this->tweetCount = intval($request->input('tweetCount'));
        $this->includeDate = intval($request->input('includeDate'));
        $this->includeDateChecked = $this->includeDate === 1 ? ' checked' : '';
    }

    protected function getViewVariables($tweets = array()) {
        return [
            'query' => $this->query,
            'tweetCount' => $this->tweetCount,
            'includeDateChecked' => $this->includeDateChecked,
            'tweets' => $tweets
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
