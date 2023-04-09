<?php

use App\Http\Controllers\PerangkatController;
use App\Http\Controllers\PerangkatItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\PerangkatItem;
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

Route::group(['middleware' => 'auth'] , function() {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('users' , UserController::class)->except(['show']);
    Route::resource('products' , ProductController::class)->except(['show']);
    Route::resource('perangkats' , PerangkatController::class);
    Route::resource('perangkatitems' , PerangkatItemController::class)->except(['index' , 'edit'  , 'create']);
});
