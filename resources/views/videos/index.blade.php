@extends('layout')

@section('content')

    <h1 class="new-video-title"><i class="fa fa-bolt"></i>{{ $title }}</h1>
    <div class="row">

        <!-- video-item -->
        @foreach ($videos as $video)
            <x-video-box :video="$video" />
        @endforeach

    </div>

    <div class="text-center" style="direction: ltr;">
        {{ $videos->links() }}
    </div>
    

@endsection
