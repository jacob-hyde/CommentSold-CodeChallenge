<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
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
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return Inertia::render('Auth/Login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [ProductController::class, 'index'])
                ->name('products.index');

            Route::get('/create', [ProductController::class, 'create'])
                ->name('products.create');

            Route::get('/{product}', [ProductController::class, 'show'])
                ->name('products.show')
                ->can('view', 'product');

            Route::post('/', [ProductController::class, 'store'])
                ->name('products.store');

            Route::put('/{product}', [ProductController::class, 'update'])
                ->name('products.update')
                ->can('update', 'product');
        });

        Route::group(['prefix' => 'inventory'], function () { // Adding a route group in case we wanted to expand in the future
            Route::get('/', [InventoryController::class, 'index'])
                ->name('inventory.index');
        });
    });
});

require __DIR__.'/auth.php';
