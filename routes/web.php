<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvitationController;


// Login page
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

// Login submit
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::get('/s/{code}', function () {
    abort(403, 'Short URLs are not public');
});


Route::middleware(['auth'])->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    // Route::get('/short-urls', [ShortUrlController::class, 'index'])
    //     ->name('short-urls.index');

    Route::get('/short-urls', [ShortUrlController::class, 'index']);
    Route::get('/s/{code}', [ShortUrlController::class, 'redirect']);

    // Route::post('/short-urls', [ShortUrlController::class, 'create'])
    //     ->name('short-urls.create');

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');


    Route::get('/invitations/create', [InvitationController::class, 'create'])
        ->name('invitations.create');

    Route::post('/invitations', [InvitationController::class, 'store'])
        ->name('invitations.store');


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::resource('users', UserController::class);

    Route::resource('short_urls', ShortUrlController::class);
});
