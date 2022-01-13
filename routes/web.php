<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BazaarController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\ExpanseController;
use App\Http\Controllers\FridayController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\StoreController;
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

    // Infaq Pedagang
    Route::resource('pedagang', MerchantController::class)->parameters([
        'pedagang' => 'merchant'
    ]);
    Route::get('/getIncomeData/{merchant}', [MerchantController::class, 'getIncomeData']);
    Route::prefix('infaq')->group(function () {
        Route::get('/pedagang', [MerchantController::class, 'income']);
    });
    Route::get('/getMerchantData/{merchant}', [MerchantController::class, 'getMerchantData']);
    Route::post('/addIncome/{merchant}', [MerchantController::class, 'addIncome']);

    // Infaq Donatur
    Route::resource('donatur', DonorController::class)->parameters([
        'donatur'   => 'donor'
    ]);
    Route::get('/donorIncomeData/{donor}', [DonorController::class, 'donorIncomeData']);
    Route::get('/getDonorData/{donor}', [DonorController::class, 'getDonorData']);
    Route::post('/addDonorIncome/{donor}', [DonorController::class, 'addIncome']);

    // Infaq Toko
    Route::resource('toko', StoreController::class)->parameters([
        'toko' => 'store_income'
    ])->except('show');

    // Jumat Berkah
    Route::prefix('jumat-berkah')->group(function () {
        Route::get('/aminah-al-fajr', [FridayController::class, 'aminah_al_fajr']);
        Route::get('/siwalan-panji', [FridayController::class, 'siwalan_panji']);
        Route::get('/buduran', [FridayController::class, 'buduran']);
        Route::get('/gedangan', [FridayController::class, 'gedangan']);
        Route::get('/tulungagung', [FridayController::class, 'tulungagung']);
    });
    Route::resource('jumat-berkah', FridayController::class)->parameters([
        'jumat-berkah' => 'friday'
    ])->except('index', 'show');

    // Bazaar
    Route::resource('bazaar', BazaarController::class)->except('show', 'create', 'edit')->parameters([
        'bazaar'    => 'expanse'
    ]);
    Route::get('/getExpanseData/{expanse}', [BazaarController::class, 'getExpanseData']);

    // Pengeluaran Lain
    Route::resource('pengeluaran-lain', ExpanseController::class)->parameters([
        'pengeluaran-lain' => 'expanse'
    ]);
});
