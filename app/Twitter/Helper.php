<?php

    namespace App\Twitter;

    class Helper {

        public static function getStatusIdFromUrl($url) {
            $matches;
            preg_match('/^https:\/\/twitter\.com\/\w+\/status\/(\d+)$/', $url, $matches);
            
            if (isset($matches[1])) {
                return intval($matches[1]);
            }

            throw new ArgumentException('This is not a valid Twitter status URL: ' . $url);
        }

        public static function getOriginalProfileImageUrl($url) {
            return str_replace('_normal', '', $url);
        }
    }