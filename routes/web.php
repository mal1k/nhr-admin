<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customers\UsersController;
use App\Http\Controllers\customers\businessController;

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

// Route::get('/', function () {
//     return dd('set corrent link');
// });

Route::redirect('/', 'manager', 301);

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['role:super-admin|admin']], function () {
        Route::resource('/manager/users', UsersController::class);
        Route::resource('/manager/business', businessController::class);
    });
});


Route::middleware(['auth:sanctum', 'verified'])->get('/manager', function () {
    return view('dashboard');
})->name('dashboard');
