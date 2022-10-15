<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
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
        return view('videos.create');
    }

    public function store(Request $request)
    {
        Video::create($request->all());

        return redirect()->route('index');
    }
}
