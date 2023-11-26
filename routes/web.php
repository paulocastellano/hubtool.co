<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AccountController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::inertia('/about', 'About')->name('about');

Route::get('/blog', [BlogController::class, 'home'])->name('blog.home');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::middleware(['auth', 'verified'])->group(function () {

    // tools
    Route::get('/tools', [ToolController::class, 'index'])->name('tools.index');
    Route::get('/tools/create', [ToolController::class, 'create'])->name('tools.create');
    Route::post('/tools', [ToolController::class, 'store'])->name('tools.store');
    Route::get('/tools/{slug}', [ToolController::class, 'show'])->name('tools.show')->withoutMiddleware('auth');
    Route::get('/tools/{id}/edit', [ToolController::class, 'edit'])->name('tools.edit');
    Route::patch('/tools/{id}', [ToolController::class, 'update'])->name('tools.update');
    Route::delete('/tools/{id}', [ToolController::class, 'destroy'])->name('tools.destroy');

    // medias
    Route::post("/medias", [MediaController::class, 'store']);
    Route::delete("/medias/{id}", [MediaController::class, 'destroy']);

    // account
    Route::get('/account', [AccountController::class, 'edit'])->name('account.edit');
    Route::post('/account', [AccountController::class, 'update'])->name('account.update');
    Route::put('/account/update-password', [AccountController::class, 'updatePassword'])->name('account.update-password');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.destroy');
    Route::delete('/account/photo', [AccountController::class, 'deletePhoto'])->name('account.photo.destroy');
});

require __DIR__ . '/auth.php';
