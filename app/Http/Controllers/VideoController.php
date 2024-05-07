<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckVerifyEmail;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Category;
use App\Models\Video;
use App\Services\FFmpegAdapter;
use App\Services\VideoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{

    public function __construct()
    {
        $this->middleware(CheckVerifyEmail::class, ['only' => ['create']]);
    }

    public function index()
    {
//        $data = ['A', 'B', 'C', 'D'];
//        return view('videos', [
//            'data' => $data,
//            'is_admin' => true
//        ]);
//        $video = Video::find(1);
        $video = Video::all();
        dd($video);
//        return $video;
    }

    public function create()
    {
        $categories = Category::all();
        return view('videos.create', compact('categories'));
    }

    public function store(StoreVideoRequest $request)
    {
        (new VideoService)->create($request->user(), $request->all());
        return redirect()->route('index')->with('alert', __('messages.success'));
    }

    public function show(Request $request, Video $video)
    {
        // N + 1 Query resolve by nested
        $video->load('comments.user');

        return view('videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        $this->authorize('update', $video);

        $categories = Category::all();
        return view('videos.edit', compact('video', 'categories'));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        $this->authorize('update', $video);

        (new VideoService)->update($video, $request->all());
        return redirect()->route('videos.show', $video->slug)->with('alert', __('messages.video_edited'));
    }
}
