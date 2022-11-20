<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

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

Route::get('/', [NoteController::class, 'index'])
    ->middleware(['auth', 'verified'])
        ->name('home');
Route::get('/create', [NoteController::class, 'create'])
    ->middleware(['auth'])
        ->name('create');

Route::middleware(['auth'])->group(function () {
    Route::prefix('/notes')->group(function () {
        Route::match(['put', 'post'], '', [NoteController::class, 'store'])
            ->middleware(['verified'])->name('store');
        Route::delete('/all', [NoteController::class, 'deleteAll'])
            ->name('deleteAll');
        Route::get('/{id}/comments', [CommentController::class, 'show'])
            ->name('show.comment');
        Route::post('/{id}/comments', [CommentController::class,'create',])
            ->name('create.comment');
        Route::get('/{id}', [NoteController::class, 'show'])
            ->name('show');
        Route::get('/{id}/edit', [NoteController::class, 'edit'])
            ->name('edit');
        Route::delete('/{id}', [NoteController::class, 'delete'])
            ->name('delete');
        Route::delete('/{id}/comments/{comment_id}', [CommentController::class,'delete',])
            ->name('delete');
        Route::get('/{id}/comments/txt', [CommentController::class,'savetext',])
            ->name('comment.txt'); 
        Route::get('/{id}/comments/excel', [CommentController::class,'saveexcel',])
            ->name('comment.excel'); 
    });
});

require __DIR__ . '/auth.php';
