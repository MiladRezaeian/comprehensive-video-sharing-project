<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $videos = Video::all();

        return view('index',[
            'videos' => $videos
        ]);
    }
}
