<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Models\Video;
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
}
