<?php

use App\Http\Controllers\BookController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Redirect::to('login');
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/books', [BookController::class, 'index'])->name('books');
    Route::get('/books/get', [BookController::class, 'get'])->name('books-get');
    Route::get('/books/create', [BookController::class, 'create'])->name('books-create');
    Route::post('/books', [BookController::class, 'store'])->name('books-store');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books-edit');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('books-update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books-delete');
});
