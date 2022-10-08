<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentralController;
use App\Http\Controllers\Graph\GraphController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [CentralController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin_dashboard', [CentralController::class, 'admin_dashboard'])->name('admin_dashboard');
    Route::post('/signin', [CentralController::class, 'signin'])->name('sign.in');
});

Route::get('larachart', [GraphController::class, 'lineChart2']);

require __DIR__ . '/auth.php';
