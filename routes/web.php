<?php

use App\Http\Controllers\Web\{HomeController};
use App\Http\Controllers\Web\Admin\{CategoryController, DashboardController, UserController};
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/admin', [DashboardController::class, 'index'])->middleware(['auth'])->name('admin');

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    /*
     * Route list to users
     */
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::resource('users', UserController::class);
    });

    /*
     * Route list to categories
     */
    Route::post('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::resource('categories', CategoryController::class);

});

require __DIR__ . '/auth.php';
