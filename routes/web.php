<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::resource('item', \App\Http\Controllers\ItemController::class);
    Route::resource('order', \App\Http\Controllers\OrderController::class);
    Route::resource('profile', \App\Http\Controllers\ProfileController::class);

    Route::get('/item/{id}/mark', [\App\Http\Controllers\ItemController::class, 'markNotification'])->name('item.mark');
    Route::get('/admin/order', [\App\Http\Controllers\OrderController::class, 'adminIndex'])->name('order.adminIndex');
});
