@extends('layouts.master')

@section('content')
    <h1>Tantu</h1>
    <form method="post" action="/">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="query">Search</label>
            <input id="query" name="query" type="text" class="form-control" value="{{ $query or '' }}">
        </div>
        <div class="form-group">
            <label for="tweetCount">Result count (max. 100)</label>
            <input id="tweetCount" name="tweetCount" type="text" class="form-control" value="{{ $tweetCount or '20' }}">
        </div>
        <div class="form-group">
            <input id="includeDate" name="includeDate" type="checkbox" value="1"{{ $includeDateChecked or '' }}>
            <label for="includeDate">Include date in export</label>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
        <section id="feed">
    
        @if (count($tweets) > 0)
            <h2>Results</h2>
        @endif
        @foreach ($tweets as $tweet)
            <div class="feeditem selected" id="{{ $tweet->id_str }}">
                <a target="_blank" href="https://twitter.com/{{ $tweet->userScreenName }}/status/{{ $tweet->id }}">
                    <img class="profileimage" src="{{ $tweet->userProfileImageUrlHttps }}">
                </a>
                <small class="time">TODO</small>
                <strong class="fullname">{{ $tweet->userName }}</strong>
                <span class="userscreenname"> {{ '@' . $tweet->userScreenName }}</span>
                <p class="tweettext" data-text="{{ $tweet->text }}">{{ $tweet->text }}</p>
            </div>
        @endforeach
        </section>
    </form>
@endsection