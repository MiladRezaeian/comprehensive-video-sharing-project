<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckVerifyEmail;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;

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
        $request->user()->videos()->create($request->all());
        return redirect()->route('index')->with('alert', __('messages.success'));
    }

    public function show(Request $request, Video $video)
    {
        return view('videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        $categories = Category::all();
        return view('videos.edit', compact('video', 'categories'));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        $video->update($request->all());

        return redirect()->route('videos.show', $video->slug)->with('alert', __('messages.video_edited'));
    }
}
