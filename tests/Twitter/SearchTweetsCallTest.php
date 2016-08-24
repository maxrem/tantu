<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Twitter\SearchTweetsCall;
use App\Twitter\Status;

use Abraham\TwitterOAuth\TwitterOAuth;

class SearchTweetsCallTest extends TestCase
{
    protected $twitterConn;
    
    /**
     * Initializes an connection to the Twitter API
     *
     */
    function __construct() {

        $this->twitterConn = new TwitterOAuth(
            env('TWITTER_CONSUMER_KEY'),
            env('TWITTER_CONSUMER_SECRET'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET')
        );
    }

    /**
     * Make a api call
     *
     * @return array apicall result
     */
    public function searchTweetsCall($q) {
        $apiCall = new SearchTweetsCall($this->twitterConn);
        $apiCall->setup($q);
        
        return $apiCall->call();
    }

    /**
     * Test if call result is an array
     *
     * @return void
     */
    public function testResultIsArray()
    {
        $this->assertEquals(true, is_array($this->searchTweetsCall(env('TWITTER_SEARCH_QUERY'))));
    }

    /**
     * Test if result contains objects of the class Status 
     *
     * @return void
     */
    public function testResultArrayContainsStatusObjects() {

        $result = $this->searchTweetsCall(env('TWITTER_SEARCH_QUERY'));

        if (count($result) > 0) {
            $this->assertInstanceOf(Status::class, $result[0]);
        }
    }

}
