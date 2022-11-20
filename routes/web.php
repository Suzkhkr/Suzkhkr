<?php

use App\Http\Controllers\DisplayController;

use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::group(['middleware' =>'auth'], function(){

    Route::get('/calendar', [DisplayController::class, 'index'])->name('calendar');
    Route::get('/myRecords', [DisplayController::class, 'myRecords'])->name('myRecords');
    Route::get('/profile', [DisplayController::class, 'profile'])->name('profile');
    Route::get('/createRecords', [DisplayController::class, 'createRecords'])->name('createRecords');
    Route::get('/timeLine', [DisplayController::class, 'timeLine'])->name('timeLine');

    // Route::post('/createCategory', [RegistrationController::class, 'createCategory'])->name('createCategory');
});
