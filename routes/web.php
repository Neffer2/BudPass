<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopperController; 
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () { 
    return view('welcome');
})->middleware('guest')->name('home');

Route::get('/dashboard', function () {
    return view('dashboard.registro');
})->middleware('auth')->name('dashboard');

Route::get('/ranking', [ShopperController::class, 'showRanking'])->middleware('auth')->name('ranking');
Route::get('/marketplace', [ShopperController::class, 'showMarketPlace'])->middleware('auth')->name('market');

require __DIR__.'/auth.php';
