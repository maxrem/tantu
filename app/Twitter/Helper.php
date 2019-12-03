<?php

namespace App\Twitter;

class Helper {
    public static function getOriginalProfileImageUrl($url) {
        return str_replace('_normal', '', $url);
    }
}