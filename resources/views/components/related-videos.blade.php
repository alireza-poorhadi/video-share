<div id="related-posts">
    <p>@lang('videos.related_videos')</p>
    <hr>
    @foreach ($videos as $video)
        @unless($video->id == $videoId)
            <!-- video item -->
            <div class="related-video-item">
                <div class="thumb">
                    <small class="time">{{ $video->lengthInHuman }}</small>
                    <a href="{{ route('videos.show', $video->slug) }}"><img src="{{ $video->thumbnail }}" alt=""></a>
                </div>
                <a href="{{ route('videos.show', $video->slug) }}" class="title">{{ $video->name }}</a>
                <a class="channel-name" href="#">{{ $video->owner_name }}<span>
                        <i class="fa fa-check-circle"></i></span></a>
            </div>
            <!-- // video item -->
        @endunless
    @endforeach





</div>
