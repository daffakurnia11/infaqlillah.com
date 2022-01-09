<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MerchantController;
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

Route::get('/login', [AdminController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [AdminController::class, 'authentication']);

Route::middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::post('/logout', [AdminController::class, 'logout']);
    Route::resource('pedagang', MerchantController::class)->parameters([
        'pedagang' => 'merchant'
    ]);
    Route::get('/getIncomeData/{merchant}', [MerchantController::class, 'getIncomeData']);
    Route::prefix('infaq')->group(function () {
        Route::get('/pedagang', [MerchantController::class, 'income']);
    });
    Route::get('/getMerchantData/{merchant}', [MerchantController::class, 'getMerchantData']);
    Route::post('/addIncome/{merchant}', [MerchantController::class, 'addIncome']);
});
