<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\CentralController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\OutOfServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FilterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'central'], function () {
    Route::post('/create', [CentralController::class, 'store']);
    Route::get('/', [CentralController::class, 'show']);
    Route::post('/test', [CentralController::class, 'test']);
});

Route::group(['middleware' => ['manage']], function () {
    Route::get('/search_item', [FilterController::class, 'item_filter']);
    Route::get('/search_booking', [FilterController::class, 'booking_filter']);
    //user authentication
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::group(['middleware' => ['authenticateSanctum']], function () {
            Route::post('/logout', [AuthController::class, 'logout']);
        });
    });

    Route::group(['middleware' => ['authenticateSanctum']], function () {

        Route::group(['middleware' => ['isOwner']], function () {
            Route::patch('store/update_store', [StoreController::class, 'update']);
            Route::get('user/get_all', [UserController::class, 'show_all']);
            Route::post('user/assign_staff', [UserController::class, 'assign_staff']);
        });

        Route::group(['middleware' => ['isStaff']], function () {
            Route::group(['prefix' => 'tag'], function () {
                Route::post('create_tag', [TagController::class, 'store']);
                Route::patch('update_tag', [TagController::class, 'update']);
            });
            Route::group(['prefix' => 'item'], function () {
                Route::patch('/update_item', [ItemController::class, 'update']);
                Route::post('/create_item', [ItemController::class, 'store']);
            });
            Route::group(['prefix' => 'out_of_service'], function () {
                Route::post('/add_item', [OutOfServiceController::class, 'store']);
                Route::get('/get_all', [OutOfServiceController::class, 'show']);
                Route::patch('/update', [OutOfServiceController::class, 'update']);
            });
            Route::post('stock/add_item_to_stock', [StockController::class, 'store']);
            Route::patch('booking/update_items_by_staff', [BookingController::class, 'update_items_by_staff']);
        });

        Route::group(['middleware' => ['isCustomer']], function () {
            Route::get('user/get_current', [UserController::class, 'show_current']);
            Route::get('store/get_store', [StoreController::class, 'show']);
            Route::get('tag/get_tags', [TagController::class, 'show']);
            Route::get('item/get_items', [ItemController::class, 'show']);
            Route::group(['prefix' => 'booking'], function () {
                Route::post('/create_booking', [BookingController::class, 'store']);
                Route::get('/get_bookings', [BookingController::class, 'show']);
                Route::patch('/update_booking', [BookingController::class, 'update_booking']);
                Route::post('/add_items', [BookingController::class, 'add_items']);
                Route::patch('/update_items_by_customer', [BookingController::class, 'update_items_by_customer']);
            });
        });
    });
});
