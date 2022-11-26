<?php

use App\Http\Controllers\DisplayController;

use App\Http\Controllers\RegistrationController;

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
    Route::get('/editProfileForm', [DisplayController::class, 'editProfileForm'])->name('editProfileForm');
    Route::post('/editProfile', [RegistrationController::class, 'editProfile'])->name('editProfile');
    Route::get('/timeLine', [DisplayController::class, 'timeLine'])->name('timeLine');
    
    Route::get('/createRecordsForm', [DisplayController::class, 'createRecordsForm'])->name('createRecordsForm');

    Route::post('/createRecords', [RegistrationController::class, 'createRecords'])->name('createRecords');
    Route::get('/detailRecords/{record}', [DisplayController::class, 'detailRecords'])->name('detailRecords');
    
    Route::get('/deleteRecords/{id}', [RegistrationController::class, 'deleteRecords'])->name('deleteRecords');

    Route::get('/editRecordsForm/{record}', [DisplayController::class, 'editRecordsForm'])->name('editRecordsForm');
    Route::post('/editRecords/{record}', [RegistrationController::class, 'editRecords'])->name('editRecords');

    Route::post('/createCategory', [RegistrationController::class, 'createCategory'])->name('createCategory');
    Route::get('/createCategoryForm', [DisplayController::class, 'createCategoryForm'])->name('createCategoryForm');
   
    Route::get('/usersList', [DisplayController::class, 'usersList'])->name('usersList');
});
