<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;



//////////////
use App\Http\Controllers\Admin\ChannelsController as AdminChannelsController;

////////
use App\Http\Controllers\User\ChannelsController as UserChannelsController;


////////
use App\Http\Controllers\TelegramController;




///////////////////////////////////////////////

Route::get('/', function () {
    return view('index');
})->name('index');



/////////////// USER
    
Route::group(['prefix'=>'user','middleware' => 'user'], function () {
    
  //  Route::get('/', function () {
  //      return view('user.index');
  //  })->name('user.index');    
    
    Route::get('/', [UserChannelsController::class, 'channels'])->name('user.index');
    Route::get('/channels', [UserChannelsController::class, 'channels'])->name('user.channels');
    Route::get('/channel/{id}', [UserChannelsController::class, 'channel'])->name('user.channels.channel');
    Route::get('/channels/add', [UserChannelsController::class, 'add'])->name('user.channels.add');
    Route::post('/channels/add', [UserChannelsController::class, 'submit'])->name('user.channels.add.submit');
    Route::get('/channels/check_tg_status', [UserChannelsController::class, 'check_tg_status'])->name('user.channels.check_tg_status');




});


/////////////// ADMIN

Route::group(['prefix'=>'admin','middleware' => 'admin'], function () {
    
    Route::get('/', function () {
      return view('admin.index');
    })->name('admin.index');      
    //Route::get('/', [AdminChannelsController::class, 'channels'])->name('admin.index'); 
    
   
    Route::get('/channels', [AdminChannelsController::class, 'channels'])->name('admin.channels');
    Route::get('/channels/edit/{id}', [AdminChannelsController::class, 'edit'])->name('admin.channels.edit');
    Route::post('/channels/edit/{id}', [AdminChannelsController::class, 'save'])->name('admin.channels.save');
    
});

/////////////////

Route::get('/login_tg', [TelegramController::class, 'login_tg'])->name('auth.login_tg');
Route::post('/check_auth', [TelegramController::class, 'check_auth'])->name('auth.check_auth');






/////////////////////////////

require __DIR__.'/auth.php';
