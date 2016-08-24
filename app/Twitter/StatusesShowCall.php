<?php

    namespace App\Twitter;

    use Abraham\TwitterOAuth\TwitterOAuth;

    class StatusesShowCall implements ApiCallInterface {

        protected $twitterConn;
        protected $data;
        protected $status;

        function __construct(TwitterOAuth $twitterConn) {
            $this->twitterConn = $twitterConn;
            $this->data = array();
        }

        public function setup($statusId) {
            $this->data['id'] = $statusId;
        }

        public function call() {
            $result = $this->twitterConn->get('statuses/show', $this->data);
            $this->status = new Status($result);

            return $this->status;
        }
    }
