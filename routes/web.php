<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\CategoryVideoController;
use App\Services\FFMpegAdapter;
use Illuminate\Support\Facades\Storage;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
Route::post('/vidoes', [VideoController::class, 'store'])->name('videos.store');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');
Route::get('/videos/{video}/edit', [VideoController::class, 'edit'])->name('videos.edit');
Route::post('/videos/{video}', [VideoController::class, 'update'])->name('videos.update');

Route::get('/categories/{category:slug}/videos', [CategoryVideoController::class, 'index'])->name('categories.videos.index');

Route::post('/video/{video}/comments', [CommentController::class, 'store'])->name('comment.store');

Route::post('/comment/{comment}/replies', [ReplyController::class, 'store'])->name('reply.store');

Route::get('/{likeable_type}/{likeable_id}/like', [LikeController::class, 'store'])->name('likes.store');
Route::get('/{likeable_type}/{likeable_id}/dislike', [DislikeController::class, 'store'])->name('dislikes.store');

Route::get('/d', function (){
    $ff = new FFMpegAdapter('3l988LkVIr7cQyLvdkVnqatkpQGkiNZWiFravYaq.mp4');
    echo $ff->getDuration();
});