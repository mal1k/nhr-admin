<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customers\UsersController;

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

Route::get('/manager/business', function () {
    return view('customers.business');
})->name('business.all');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/manager/users', UsersController::class);
});


Route::middleware(['auth:sanctum', 'verified'])->get('/manager', function () {
    return view('dashboard');
})->name('dashboard');
