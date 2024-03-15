<?php

use App\Http\Controllers\ShopperController; 
use App\Http\Controllers\AdminController; 
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Return_;

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
 
/*
|--------------------------------------------------------------------------
| Shopper routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () { 
    return view('welcome');
})->middleware('guest')->name('home');

Route::get('/dashboard', function () {
    return view('dashboard.registro');
})->middleware('shopper')->middleware('auth')->middleware('descalificado')->name('dashboard');

Route::get('/marketplace', function () {
    return view('dashboard.marketPlace');
})->middleware('shopper')->middleware('auth')->middleware('descalificado')->name('market');

// Route::get('/ranking', [ShopperController::class, 'showRanking'])->middleware('auth')->middleware('descalificado')->name('ranking');
Route::get('/ranking', function () {
    return redirect()->route('market');
})->name('ranking');
Route::get('/trial', [ShopperController::class, 'mail']);

Route::get('/trial', [ShopperController::class, 'mail']);
/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/
Route::get('/facturas', [AdminController::class, 'index'])->middleware('admin')->middleware('auth')->name('facturas');
Route::get('/factura/{id}', [AdminController::class, 'factura'])->middleware('admin')->middleware('auth')->name('factura'); 
Route::get('/redencion/{id}', [AdminController::class, 'redencion'])->middleware('admin')->middleware('auth')->name('redencion'); 

require __DIR__.'/auth.php';
