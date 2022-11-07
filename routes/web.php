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


Route::get('/kadena', function () {   return view('kadena');})
    ->middleware(['auth', 'verified']);
Route::get('/', [NoteController::class, 'index'])
    ->middleware(['auth', 'verified']) ->name('home');
Route::match(['put', 'post'], '/notes', [NoteController::class, 'store'])
    ->middleware(['auth', 'verified']) ->name('store');
Route::delete('/notes/all', [NoteController::class, 'deleteAll'])
    ->middleware(['auth'])->name('deleteAll');
Route::get('/notes/{id}/comments', [CommentController::class, 'show'])
    ->middleware(['auth']) ->name('show.comment');
Route::post('/notes/{id}/comments', [CommentController::class, 'create'])
    ->middleware(['auth']) ->name('create.comment');
Route::get('/notes/{id}', [NoteController::class, 'show'])
    ->middleware(['auth']) ->name('show');
Route::get('/notes/{id}/edit', [NoteController::class, 'edit'])
    ->middleware(['auth']) ->name('edit');
Route::delete('/notes/{id}', [NoteController::class, 'delete'])
    ->middleware(['auth']) ->name('delete');
Route::delete('/notes/{id}/comments/{comment_id}', [CommentController::class, 'delete'])
    ->middleware(['auth']) ->name('delete');

    Route::get('/create', [NoteController::class, 'create'])
    ->middleware(['auth']) ->name('create');

    
require __DIR__ . '/auth.php';

