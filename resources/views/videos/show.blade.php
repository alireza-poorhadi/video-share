@extends('layout')

@section('content')
    <x-validation-errors />

    <div class="col-md-8">
        <div id="watch">

            <!-- Video Player -->
            <h1 class="video-title">{{ $video->name }}</h1>
            <div class="video-code">
                <video controls style="height: 100%; width: 100%;">
                    <source src="{{ $video->video_url }}" type="video/mp4">
                </video>
            </div><!-- // video-code -->
            <div>
                <p style="color: black">{{ $video->description }}</p>
            </div>

            <div class="video-share">
                <ul class="like">
                    <li><a class="deslike" href="{{ route('dislikes.store', ['likeable_type' => 'video', 'likeable_id' => $video]) }}">{{ $video->dislikes_count }} <i
                                class="fa fa-thumbs-down"></i></a></li>
                    <li><a class="like"
                            href="{{ route('likes.store', ['likeable_type' => 'video', 'likeable_id' => $video]) }}">{{ $video->likes_count }} <i
                                class="fa fa-thumbs-up"></i></a>
                    </li>
                </ul>
                
            </div><!-- // video-share -->
            <!-- // Video Player -->


            <!-- Chanels Item -->
            <div class="chanel-item">
                <div class="chanel-thumb">
                    <a href="#"><img src="{{ $video->owner_gravatar }}" alt="{{ $video->owner_name }}"></a>
                </div>
                <div class="chanel-info">
                    <a class="title" href="#">{{ $video->owner_name }}</a>
                </div>
            </div>
            <!-- // Chanels Item -->


            <!-- Comments -->
            <div id="comments" class="post-comments">
                <h3 class="post-box-title"><span>{{ $video->comments->count() }} </span>@lang('videos.comments')</h3>
                <ul class="comments-list">

                    @foreach ($video->comments as $comment)
                        <li>
                            <div class="post_author">
                                <div class="img_in">
                                    <a href="#"><img src="{{ $comment->user->gravatar }}"
                                            alt="{{ $comment->user->name }}"></a>
                                </div>
                                <a href="#" class="author-name">{{ $comment->user->name }}</a>
                                <time datetime="2017-03-24T18:18">{{ $comment->created_at_in_human }}</time>
                                <a class="deslike" href="{{ route('dislikes.store', ['likeable_type' => 'comment', 'likeable_id' => $comment]) }}"
                                    style="width: 20px; margin-right:20px; color: #aaaaaa"><i
                                        class="fa fa-thumbs-down"> {{ $comment->dislikes_count }} </i></a>
                                <a class="like" style="width: 20px; margin-right:10px; color: #66c0c2"
                                    href="{{ route('likes.store', ['likeable_type' => 'comment', 'likeable_id' => $comment]) }}">{{ $comment->likes_count }} <i
                                        class="fa fa-thumbs-up"></i></a>
                            </div>
                            <p>{{ $comment->body }}</p>

                            <button class="reply btn" onclick="openReplyBox(this);">@lang('videos.reply')</button>
                            {{-- ----------------------------------------- --}}
                            {{-- Reply Box --}}
                            <div class="reply-box" style="display: none;">
                                @auth
                                    <h3 class="post-box-title">@lang('videos.write_your_reply')</h3>
                                    <form action="{{ route('reply.store', $comment) }}" method="POST">
                                        @csrf
                                        <textarea class="form-control" name="body" rows="8" id="Message" placeholder="{{ __('videos.reply') }}"></textarea>
                                        <button type="submit" id="contact_submit"
                                            class="btn btn-dm">@lang('videos.send_reply')</button>
                                    </form>
                                @endauth
                                @guest
                                    <h3 class="post-box-title">@lang('videos.log_in_to_send_reply') <a class="btn btn-success"
                                            href="{{ route('login') }}">@lang('Log in')</a></h3>

                                @endguest
                            </div>
                            <br><br>
                            {{-- ------------------------------------------- --}}
                            <ul class="children">
                                @foreach ($comment->replies as $reply)
                                    <li>
                                        <div class="post_author">
                                            <div class="img_in">
                                                <a href="#"><img src="{{ $reply->user->gravatar }}"
                                                        alt="{{ $reply->user->name }}"></a>
                                            </div>
                                            <a href="#" class="author-name">{{ $reply->user->name }}</a>
                                            <time datetime="2017-03-24T18:18">{{ $reply->created_at_in_human }}</time>
                                        </div>
                                        <p>{{ $reply->body }}</p>
                                    </li>
                                @endforeach

                            </ul>


                        </li>
                    @endforeach
                </ul>
                @auth
                    <h3 class="post-box-title">@lang('videos.write_your_comment')</h3>
                    <form action="{{ route('comment.store', $video) }}" method="POST">
                        @csrf
                        <textarea class="form-control" name="body" rows="8" id="Message"
                            placeholder="{{ __('videos.comments') }}"></textarea>
                        <button type="submit" id="contact_submit" class="btn btn-dm">@lang('videos.send_comment')</button>
                    </form>
                @endauth
                @guest
                    <h3 class="post-box-title">@lang('videos.log_in_to_send_comment') <a class="btn btn-success"
                            href="{{ route('login') }}">@lang('Log in')</a></h3>

                @endguest

            </div>
            <!-- // Comments -->


        </div><!-- // watch -->
    </div><!-- // col-md-8 -->
    <!-- // Watch -->

    <!-- Related Posts-->
    <div class="col-md-4">
        <x-related-videos :video="$video"></x-related-videos>
    </div><!-- // col-md-4 -->
    <!-- // Related Posts -->
    <script>
        function openReplyBox(button) {
            var replyBox = button.nextSibling.nextSibling;

            if (replyBox.style.display === 'none') {
                replyBox.style.display = 'block';
            } else {
                replyBox.style.display = 'none';
            }
        }
    </script>
@endsection
