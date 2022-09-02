<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentralController;
use App\Http\Controllers\ViewController;

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
    $response = "";
    return view('home', compact('response'));
})->name('home');
Route::post('/signin', [CentralController::class, 'signin'])->name('sign.in');

// Route::get('/login', [ViewController::class, 'login_view'])->name('login');
// Route::get('/register', [ViewController::class, 'register_view'])->name('register');
// Route::post('/loginPOST', [ViewController::class, 'login'])->name('login.post');
// Route::post('/registerPOST', [ViewController::class, 'register'])->name('register.post');

// Route::middleware(['auth:sanctum'])->group(function () {
// });
