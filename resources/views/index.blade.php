@extends('layout')

@section('content')

    <h1 class="new-video-title"><i class="fa fa-bolt"></i>@lang('videos.latest-videos') </h1>
    <div class="row">

        <!-- video-item -->
        @foreach ($videos as $video)
            <x-video-box :video="$video" />
        @endforeach

    </div>
    <h1 class="new-video-title"><i class="fa fa-bolt"></i>@lang('videos.most-watched-videos')</h1>
    <div class="row">
        @foreach ($mostWatchedVideos as $video)
            <x-video-box :video="$video" />
        @endforeach

    </div>

    <h1 class="new-video-title"><i class="fa fa-bolt"></i>@lang('videos.favorite-videos')</h1>
    <div class="row">
        @foreach ($mostPopularVideos as $video)
            <x-video-box :video="$video" />
        @endforeach
    </div>

@endsection
