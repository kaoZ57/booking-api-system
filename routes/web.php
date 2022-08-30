<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentralController;

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

Route::view('/', 'welcome')->name('welcome');
Route::get('/home', function () {
    return view('home')->with('response');
})->name('home');
Route::post('/signin', [CentralController::class, 'signin'])->name('sign.in');
