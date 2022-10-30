<?php

use App\Http\Controllers\NoteController;
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

Route::get('/kadena', function () {   return view('kadena');});
Route::get('/',[NoteController::class,'index'])->name('home');
Route::post('/notes', [NoteController::class,'store'])->name('store');

