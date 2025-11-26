<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\MovieController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;

// Public Routes
Route::get('/', [MovieController::class, 'index'])->name('home');
Route::get('/movie/{movie}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/download/{movie}', [MovieController::class, 'download'])->name('movies.download');

// Search route
Route::get('/search', [MovieController::class, 'index'])->name('movies.search');

// Secret Admin Routes - No authentication required, hidden from public
Route::prefix('secret-dashboard-mv2024')->name('admin.')->group(function () {
    Route::get('/', function () {
        return 'Admin panel is working! <a href="movies">Go to Movies</a>';
    });
    Route::resource('movies', AdminMovieController::class);
});

// Test route for debugging
Route::get('test-admin', function () {
    return 'Admin routes are working!';
});
