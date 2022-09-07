<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Http\Requests\VideoStoreRequest;
use App\Http\Requests\VideoUpdateRequest;
use App\Services\VideoCreationAndUpdateService;

class VideoController extends Controller
{
    public function show(Video $video)
    {
        return new VideoResource($video);
    }

    public function index(Request $request)
    {
        $videos = Video::filter($request->all())->paginate(2);

        return VideoResource::collection($videos);
    }

    public function store(VideoStoreRequest $request)
    {
        (new VideoCreationAndUpdateService)->create($request->user(), $request->all());

        return response()->json([
            'message' => 'Video was created'
        ], 201);
    }

    public function update(VideoUpdateRequest $request, Video $video)
    {
        $this->authorize('update', $video);

        (new VideoCreationAndUpdateService)->update($video, $request->all());

        return response()->json([
            'message' => 'Video was updated'
        ], 200);
    }

    public function destroy(Video $video)
    {
        $this->authorize('delete', $video);
        
        $video->delete();

        return response()->json([
            'message' => 'Video was deleted'
        ], 200);
    }
}
