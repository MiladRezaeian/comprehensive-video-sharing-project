<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\VideoController;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', [IndexController::class, 'index']);

Route::get('/', [IndexController::class, 'index']);

Route::get('/videos/create', [VideoController::class, 'create']);

Route::get('/upload', function (){
    return view('videos.create');
});

Route::get('/videos', [VideoController::class, 'index']);

Route::get('/factory', function (){
    Video::factory()->create();
});
