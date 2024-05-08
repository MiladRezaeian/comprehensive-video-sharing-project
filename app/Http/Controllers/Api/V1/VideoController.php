<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Http\Resources\VideoResource;
use App\Models\User;
use App\Models\Video;
use App\Services\VideoService;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show(Video $video)
    {
        return new VideoResource($video);
    }

    public function index(Request $request)
    {
        $video = Video::filter($request->all())->paginate();

        return VideoResource::collection($video);
    }

    public function store(StoreVideoRequest $request)
    {
        (new VideoService)->create(User::first(), $request->all());

        return response()->json([
            'message' => 'Video created'
        ], 201);
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        (new VideoService)->update($video, $request->all());

        return response()->json([], 204);
    }
}
