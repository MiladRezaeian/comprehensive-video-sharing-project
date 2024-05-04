<?php

use App\Events\VideoCreated;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DisLikeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryVideoController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\VideoController;
use App\Jobs\ProcessVideo;
use App\Mail\VerifyEmail;
use App\Models\User;
use App\Models\Video;

use App\Notifications\VideoProcessed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');
Route::get('/videos/{video}/edit', [VideoController::class, 'edit'])->name('videos.edit');
Route::post('/videos/{video}/', [VideoController::class, 'update'])->name('videos.update');

Route::get('/categories/{category:slug}/videos', [CategoryVideoController::class, 'index'])->name('categories.videos.index');

Route::get('/upload', function () {
    return view('videos.create');
});

Route::get('/videos', [VideoController::class, 'index']);

Route::get('/factory', function () {
    Video::factory()->create();
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/email', function () {
    $user = User::first();
    Mail::to('milad.rezaeiann@gmail.com')->send(new VerifyEmail($user));
});

Route::get('/verify/{id}', function () {
    dd(request()->hasValidSignature());
})->name('verify');

Route::get('/generate', function () {
    echo URL::temporarySignedRoute('verify', now()->addSeconds(20), ['id' => 5]);
});

Route::get('/jobs', function () {
    ProcessVideo::dispatch();
});

Route::get('/event', function () {
    $video = Video::first();
    VideoCreated::dispatch($video);
});

Route::get('/notify', function () {
    $user = User::first();
    $video = Video::first();
    $user->notify(new VideoProcessed($video));
});

Route::post('/videos/{video}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/{likeable_type}/{likeable_id}/like', [LikeController::class,'store'])->name('likes.store');
Route::get('/{likeable_type}/{likeable_id}/dislike', [DisLikeController::class,'store'])->name('dislikes.store');
