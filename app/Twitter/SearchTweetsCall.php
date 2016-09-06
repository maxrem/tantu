<?php

namespace App\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;

class SearchTweetsCall implements ApiCallInterface {

    protected $twitterConn;
    protected $data;
    protected $status;

    function __construct(TwitterOAuth $twitterConn) {
        $this->twitterConn = $twitterConn;
        $this->data = array();
    }

    public function setup($q, $geocode = false) {
        $this->data['q'] = $q;

        if ($geocode) {
            $this->data['geocode'] = $geocode;
        }
    }

    public function call() {
        $result = $this->twitterConn->get('search/tweets', $this->data);
        
        $tweets = array();
        if (isset($result->statuses)) {
            foreach ($result->statuses as $status) {
                $tweets[] = new Status($status);
            }
        }
        
        return $tweets;
    }
}