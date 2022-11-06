<?php

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

//Route::get('/', function () {    return view('welcome');});
Route::get('/kadena', function () {   return view('kadena');})
    ->middleware(['auth', 'verified']);
Route::get('/', [NoteController::class, 'index'])
    ->middleware(['auth', 'verified']) ->name('home');
Route::match(['put', 'post'], '/notes', [NoteController::class, 'store'])
    ->middleware(['auth', 'verified']) ->name('store');
Route::delete('/notes/all', [NoteController::class, 'deleteAll'])
    ->middleware(['auth'])->name('deleteAll');

Route::get('/notes/{id}', [NoteController::class, 'show'])
    ->middleware(['auth']) ->name('show');
Route::get('/notes/{id}/edit', [NoteController::class, 'edit'])
    ->middleware(['auth']) ->name('edit');

Route::delete('/notes/{id}', [NoteController::class, 'delete'])
    ->middleware(['auth']) ->name('delete');

require __DIR__ . '/auth.php';

