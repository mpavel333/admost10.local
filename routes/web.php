<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});



/////////////// USER
    
Route::group(['prefix'=>'/','middleware' => 'user'], function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');    
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');









});



/////////////// ADMIN


Route::group(['prefix'=>'admin','middleware' => 'admin'], function () {
    
    
    Route::get('/', [ProfileController::class, 'admin'])->name('profile.admin');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');








});

/////////////////

Route::get('/login_tg', [ProfileController::class, 'login_tg'])->name('auth.login_tg');
Route::post('/check_auth', [ProfileController::class, 'check_auth'])->name('auth.check_auth');













/////////////////////////////

require __DIR__.'/auth.php';
