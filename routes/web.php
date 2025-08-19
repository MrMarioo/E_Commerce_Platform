<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix(prefix: 'category')->group(function (){
       Route::controller(controller: CategoryController::class)->group(function (){
            Route::resource(name: 'category', controller: CategoryController::class);
       });
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
