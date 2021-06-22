<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes(['verify' => true]);

Route::get('/',  [App\Http\Controllers\Controller::class, 'index'])->name('index');
Route::post('/',  [App\Http\Controllers\Controller::class, 'indexHandler'])->name('indexHandler');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/{url}',[App\Http\Controllers\Controller::class, 'paste'])->name('paste');
