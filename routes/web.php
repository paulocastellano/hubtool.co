<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\BillingController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::post('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

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
    Route::get('/tools/{id}/edit', [ToolController::class, 'edit'])->name('tools.edit');
    Route::post('/tools/{id}', [ToolController::class, 'update'])->name('tools.update');
    Route::delete('/tools/{id}', [ToolController::class, 'destroy'])->name('tools.destroy');
    Route::post('/tools/images', [ToolController::class, 'imageHandler'])->name('tools.image-handler');
    Route::get('/tool-search', [ToolController::class, 'search'])->name('tools.search');

    // billing
    Route::get('/billing/{id}/skip-line', [BillingController::class, 'skipeLine'])->name('billing.skip-line');
    Route::get('/billing/{id}/skip-line/success', [BillingController::class, 'skipeLineSuccess'])->name('billing.skip-line-success');
    Route::get('/billing/portal', [BillingController::class, 'billingPortal'])->name('billing.portal');

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

Route::get('/{slug}', [ToolController::class, 'show'])->name('tools.show')->withoutMiddleware('auth');

require __DIR__ . '/auth.php';
