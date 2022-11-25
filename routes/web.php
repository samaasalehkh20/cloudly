<?php

use App\Http\Controllers\AllKeysController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UploadImageController;
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
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::namespace('/')
    ->prefix('/upload_image')
    ->middleware(['auth'])
    ->group(function () {

        Route::group([
            'as' => 'upload_image.',
        ], function () {
            Route::get('/create', [UploadImageController::class, 'create'])->name('create');
            Route::post('/', [UploadImageController::class, 'store'])->name('store');
            Route::get('/getRecent', [UploadImageController::class, 'getRecent'])->name('getRecent');
        });
    });

Route::namespace('/')
    ->prefix('/all_keys')
    ->middleware(['auth'])
    ->group(function () {

        Route::group([
            'as' => 'all_keys.',
        ], function () {
            Route::get('/', [AllKeysController::class, 'index'])->name('index');
            Route::get('/clear', [AllKeysController::class, 'clear'])->name('clear');
        });
    });

Route::namespace('/')
    ->prefix('/search')
    ->middleware(['auth'])
    ->group(function () {

        Route::group([
            'as' => 'search.',
        ], function () {
            Route::get('/search', [SearchController::class, 'search'])->name('search');
            Route::get('/', [SearchController::class, 'index'])->name('index');
        });
    });

Route::namespace('/')
    ->prefix('/recently')
    ->middleware(['auth'])
    ->group(function () {

        Route::group([
            'as' => 'recent.',
        ], function () {
            Route::get('/', [RecentController::class, 'index'])->name('index');
        });
    });
