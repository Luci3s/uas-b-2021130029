<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AppController::class, 'index'])->name('app.index');

Route::resource('items', ItemController::class);

Route::get('/order', [OrderController::class, 'order'])->name('order.index');

Route::post('/order/create', [OrderController::class, 'createOrder'])->name('order.createOrder');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
