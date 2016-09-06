<?php

namespace App\Twitter;

use App\Twitter\Helper;
use Carbon\Carbon;

class Status {
    public $id;
    public $userId;
    public $userName;
    public $userScreenName;
    public $userProfileBackgroundColor;
    public $userProfileImageUrlHttps;
    public $userProfileImageUrl;
    public $userProfileImageUrlOriginal;
    public $userProfileImageUrlOriginalHttps;
    public $text;
    public $created_at;

    function __construct($result) {

        $this->id = $result->id;
        $this->id_str = (string) $result->id;
        $this->text = $result->text;

        $this->userId = $result->user->id;
        $this->userName = $result->user->name;
        $this->userScreenName = $result->user->screen_name;
        $this->userProfileBackgroundColor = $result->user->profile_background_color;
        $this->userProfileImageUrlHttps = $result->user->profile_image_url_https;
        $this->userProfileImageUrl = $result->user->profile_image_url;
        $this->userProfileImageUrlOriginalHttps = Helper::getOriginalProfileImageUrl($result->user->profile_image_url_https);
        $this->userProfileImageUrlOriginal = Helper::getOriginalProfileImageUrl($result->user->profile_image_url);
        $this->created_at = new Carbon($result->created_at);
    }
}