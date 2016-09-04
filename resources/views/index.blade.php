@extends('layouts.master')

@section('content')
    
    <div id="app" class="col-md-6 col-md-offset-3">
        <h1>Tantu</h1>
        {{ csrf_field() }}
        <div class="form-group">
            <label for="query">Search</label>
            <input id="query" name="query" type="text" class="form-control"
                value="{{ $query or '' }}" v-model="query"
            >
        </div>
        <div class="form-group">
            <label for="tweetCount">Result count (max. 100)</label>
            <input id="tweetCount" name="tweetCount" type="text" class="form-control" value="{{ $tweetCount or '20' }}">
        </div>
        <div class="form-group">
            <input id="includeDate" name="includeDate" type="checkbox" value="1"{{ $includeDateChecked or '' }}>
            <label for="includeDate">Include date in export</label>
        </div>
        <button class="btn btn-default" @click="searchTweets">Submit</button>
        
        <section id="results">
            <h2 v-show="results.length > 0">Results</h2>
            <div class="feeditem selected" id="@{{ tweet.id_str }}" v-for="tweet in results">
                <a target="_blank" href="https://twitter.com/@{{ tweet.userScreenName }}/status/@{{ tweet.id }}">
                    <img class="profileimage" v-bind:src="tweet.userProfileImageUrlHttps">
                </a>
                <small class="time">TODO</small>
                <strong class="fullname">@{{ tweet.userName }}</strong>
                <span class="userscreenname"> @{{ '@' + tweet.userScreenName }}</span>
                <p class="tweettext" data-text="@{{ tweet.text }}">@{{ tweet.text }}</p>
            </div>
        </section>
    </div>
    
@stop