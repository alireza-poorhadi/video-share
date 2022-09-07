<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\FFMpegAdapter;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\VideoStoreRequest;
use App\Http\Requests\VideoUpdateRequest;
use App\Services\VideoCreationAndUpdateService;

class VideoController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view('videos.create', compact('categories'));
    }

    public function store(VideoStoreRequest $request)
    {
        (new VideoCreationAndUpdateService)->create($request->user(), $request->all());

        return redirect()->route('index')->with('alert', __('messages.success'));
    }

    public function show(Request $request, Video $video)
    {
        $video->load('comments.user', 'comments.replies', 'comments.replies.user');
        return view('videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        $categories = Category::all();

        return view('videos.edit', compact('video', 'categories'));
    }

    public function update(VideoUpdateRequest $request, Video $video)
    {
        (new VideoCreationAndUpdateService)->update($video, $request->all());
        
        return redirect()->route('videos.show', $video->slug)->with('alert', __('messages.video-edited'));
    }
}
