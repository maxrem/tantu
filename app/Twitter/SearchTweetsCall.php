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

    public function setup($q, $count = null, $geocode = null) {
        $this->data['q'] = $q;

        if ($geocode) {
            $this->data['geocode'] = $geocode;
        }

        if ($count) {
            $count = intval($count);

            $count = $count > 100 ? 100 : $count;
            $count = $count < 0 ? 0 : $count;

            $this->data['count'] = $count;
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