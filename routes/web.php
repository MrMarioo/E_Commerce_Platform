<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductsImageController ;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::prefix(prefix: 'category')->group(function (){
       Route::controller(controller: CategoryController::class)->group(function (){
            Route::resource(name: 'category', controller: CategoryController::class);
       });
    });
    Route::prefix(prefix: 'brand')->group(function (){
        Route::controller(controller: BrandController::class)->group(function (){
            Route::resource(name: 'brand', controller: BrandController::class);
        });
    });
    Route::prefix(prefix: 'product')->group(function (){
        Route::controller(controller: ProductController::class)->group(function (){
            Route::resource(name: 'product', controller: ProductController::class);
        });
    });
    Route::prefix(prefix: 'productImage')->group(function (){
        Route::controller(controller: ProductsImageController::class)->group(function (){
            Route::resource(name: 'products-images', controller: ProductsImageController::class);
        });
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
