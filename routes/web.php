<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuggestionsController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ConnectionsController;

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
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('suggestions',[SuggestionsController::class,'get']);
Route::get('connect/{id}',[SuggestionsController::class,'connect']);
Route::get('sent',[RequestController::class, 'get']);
Route::get('received',[RequestController::class, 'requested']);
Route::get('withdraw/{id}',[RequestController::class, 'withdraw']);
Route::get('accept/{id}',[RequestController::class, 'accept']);
Route::get('remove/{id}',[ConnectionsController::class, 'remove']);

Route::get('connection',[ConnectionsController::class, 'get']);
Route::get('common/{id}',[ConnectionsController::class, 'common']);






