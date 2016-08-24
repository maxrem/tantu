<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Twitter\StatusesShowCall;
use App\Twitter\Status;

use Abraham\TwitterOAuth\TwitterOAuth;

class StatusesShowCallTest extends TestCase
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
    public function statusesShowCall($id) {
        $apiCall = new StatusesShowCall($this->twitterConn);
        $apiCall->setup($id);
        
        return $apiCall->call();
    }

    /**
     * Check if call result is instance of Status class
     *
     * @return void
     */
    public function testResultIsInstanceOfStatus()
    {
        $status = $this->statusesShowCall(env('TWITTER_STATUS_ID'));
        $this->assertInstanceOf(Status::class, $status);
    }

    /**
     * Check if Status text is not empty 
     *
     * @return void
     */
    public function testStatusTextIsNotEmpty()
    {
        $status = $this->statusesShowCall(env('TWITTER_STATUS_ID'));
        $this->assertNotEmpty($status->text);
    }

    /**
     * Check if Status text start with 'PHP 5.6.22 has been released'
     *
     * @return void
     */
    public function testStatusTextStartsWith()
    {
        $status = $this->statusesShowCall(env('TWITTER_STATUS_ID'));
        $this->assertStringStartsWith('PHP 5.6.22 has been released', $status->text);
    }

}
