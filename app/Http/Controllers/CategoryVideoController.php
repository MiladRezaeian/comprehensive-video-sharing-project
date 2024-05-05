<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryVideoController extends Controller
{
    public function index(Request $request, Category $category)
    {
        $videos = $category->videos();

        if ($request->has('length') && $request->length == 1) {
            $videos = $videos->where('length', '<', 60);
        }
        if ($request->has('length') && $request->length == 2) {
            $videos = $videos->whereBetween('length', [60, 300]);
        }
        if ($request->has('length') && $request->length == 2) {
            $videos = $videos->where('length', '>', 300);
        }

        $videos = $videos->paginate();
        $title = $category->name;

        return view('videos.index', compact('videos', 'title'));
    }
}
