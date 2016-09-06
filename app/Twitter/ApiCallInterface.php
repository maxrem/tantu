<?php

namespace App\Twitter;

interface ApiCallInterface {
    public function setup($data);
    public function call();
}