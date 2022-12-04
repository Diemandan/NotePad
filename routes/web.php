<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Models\Note;

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
    ->middleware(['auth', 'verified', 'activity'])->name('home');

Route::get('/create', [NoteController::class, 'create'])
    ->middleware(['auth'])->name('create');

Route::middleware('admin', 'auth')->group(function () {

    Route::get('/admin', [UserController::class, 'showAll'])
        ->name('admin');

    Route::put('/admin/status', [UserController::class, 'userStatus'])
        ->name('user.status');

    Route::delete('/admin/{id}', [UserController::class, 'delete'])
        ->name('user.delete');

        Route::post('/admin/notifications', [NotificationController::class, 'create']);
});

Route::get('/admin/notifications', [NotificationController::class, 'show'])->name('admin.show');

Route::middleware(['auth', 'activity'])->group(function () {
    Route::prefix('/notes')->group(function () {

        Route::post('', [NoteController::class, 'store'])
            ->middleware(['verified'])->name('store');

        Route::put('', [NoteController::class, 'update'])
            ->middleware(['verified'])->name('update');

        Route::delete('/all', [NoteController::class, 'deleteAll'])
            ->name('deleteAll');

        Route::get('/txt', [NoteController::class, 'downloadtext',])
            ->name('notes.txt');

        Route::get('/excel', [NoteController::class, 'downloadexcel',])
            ->name('notes.excel');

        Route::get('/{id}/comments', [CommentController::class, 'show'])
            ->name('show.comment');

        Route::post('/{id}/comments', [CommentController::class, 'create',])
            ->name('create.comment');

        Route::get('/{id}', [NoteController::class, 'show'])
            ->name('show');

        Route::get('/{id}/edit', [NoteController::class, 'edit'])
            ->name('edit');

        Route::delete('/{id}', [NoteController::class, 'delete'])
            ->name('delete');

        Route::delete('/{id}/comments/{comment_id}', [CommentController::class, 'delete',])
            ->name('delete');
    });
});

require __DIR__ . '/auth.php';
