<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\Authenticate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');



/////////////// USER
    
Route::group(['prefix'=>'user','middleware' => 'user'], function () {
    
  //  Route::get('/', function () {
  //      return view('user.index');
  //  })->name('user.index');    
    
    Route::get('/', [UserController::class, 'channels'])->name('user.index');

    Route::get('/channels', [UserController::class, 'channels'])->name('user.channels');


    Route::get('/channel/{id}', [UserController::class, 'channel'])->name('user.channels.channel');

    Route::get('/channels/add', [UserController::class, 'add'])->name('user.channels.add');

    Route::post('/channels/add', [UserController::class, 'submit'])->name('user.channels.add.submit');



    Route::get('/channels/check_tg_status', [UserController::class, 'check_tg_status'])->name('user.channels.check_tg_status');




});



/////////////// ADMIN


Route::group(['prefix'=>'admin','middleware' => 'admin'], function () {
    
    
    Route::get('/', [ProfileController::class, 'admin'])->name('admin.index'); 
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');








});

/////////////////

Route::get('/login_tg', [ProfileController::class, 'login_tg'])->name('auth.login_tg');
Route::post('/check_auth', [ProfileController::class, 'check_auth'])->name('auth.check_auth');













/////////////////////////////

require __DIR__.'/auth.php';
