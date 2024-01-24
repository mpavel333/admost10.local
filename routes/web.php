<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;



//////////////
use App\Http\Controllers\Admin\ChannelsController as AdminChannelsController;
use App\Http\Controllers\Admin\TariffsController as AdminTariffsController;

////////
use App\Http\Controllers\User\ChannelsController as UserChannelsController;
use App\Http\Controllers\User\OrdersController as UserOrdersController;
use App\Http\Controllers\User\PublicationsController as UserPublicationsController;
use App\Http\Controllers\User\BalanceController as UserBalanceController;
use App\Http\Controllers\User\UserController as UserController;



////////
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\DropzoneController;
use App\Http\Controllers\ChannelsController;
use App\Http\Controllers\ChatController;



//������������ ������
Route::get('setlocale/{lang}', function ($lang='ua') {

    $referer = Redirect::back()->getTargetUrl(); //URL ���������� ��������
    $parse_url = parse_url($referer, PHP_URL_PATH); //URI ���������� ��������
    
    //��������� �� ������ �� �����������
    $segments = explode('/', $parse_url);
    
    //���� URL (��� ������ �� ������������ �����) �������� ���������� ����� �����
    if (in_array($segments[1], App\Http\Middleware\LocaleMiddleware::$languages)) {

        unset($segments[1]); //������� �����
    }

    //��������� ����� ����� � URL (���� ������ �� ���� ��-���������)
    if ($lang != App\Http\Middleware\LocaleMiddleware::$mainLanguage){
        array_splice($segments, 1, 0, $lang);
    }

    //��������� ������ URL
    $url = Request::root().implode("/", $segments);

    //���� ���� ��� GET-��������� - ��������� ��
    if(parse_url($referer, PHP_URL_QUERY)){
        $url = $url.'?'. parse_url($referer, PHP_URL_QUERY);
    }
    return redirect($url); //�������������� ����� �� �� �� ��������

})->name('setlocale');





Route::group(['prefix' => App\Http\Middleware\LocaleMiddleware::getLocale()], function(){  


        
        
        Route::get('/', function () {
            return view('index');
        })->name('index'); 
        
        
        
        Route::get('/channels', [ChannelsController::class, 'channels'])->name('channels');
        Route::get('/channel/{id}', [ChannelsController::class, 'channel'])->name('channels.channel');
        
        /////////////// USER
            
        Route::group(['prefix'=>'user','middleware' => 'user'], function () {
            
          //  Route::get('/', function () {
          //      return view('user.index');
          //  })->name('user.index');    
            
            Route::get('/', [UserChannelsController::class, 'channels'])->name('user.index');
        
        
        
            Route::get('/balance', [UserBalanceController::class, 'index'])->name('user.balance.index');  
            Route::post('/balance/add', [UserBalanceController::class, 'submit'])->name('user.balance.add.submit');  
            //Route::post('/publication', [UserPublicationsController::class, 'submit'])->name('user.publications.submit');  
        
            Route::get('/report', [UserController::class, 'getReport'])->name('user.report.index');  
        
            
            
            Route::get('/publication', [UserPublicationsController::class, 'add'])->name('user.publications.add');  
            Route::post('/publication', [UserPublicationsController::class, 'submit'])->name('user.publications.submit');  
        
            Route::get('/publications', [UserPublicationsController::class, 'publications'])->name('user.publications');  
            Route::get('/publications/{id}/edit', [UserPublicationsController::class, 'edit'])->name('user.publications.edit');
            Route::post('/publications/{id}/edit', [UserPublicationsController::class, 'submit'])->name('user.publications.edit.submit');  
             
        
            Route::get('/publications/{id}/{hash}/published', [UserPublicationsController::class, 'published'])->name('user.publications.published');
            Route::get('/publications/{id}/{hash}/cancel', [UserPublicationsController::class, 'cancel'])->name('user.publications.cancel');
            
                
            
            Route::get('/channels', [UserChannelsController::class, 'channels'])->name('user.channels');
            Route::get('/channel/edit/{id}', [UserChannelsController::class, 'edit'])->name('user.channels.edit');
            Route::post('/channel/edit/{id}', [UserChannelsController::class, 'edit_submit'])->name('user.channels.edit.submit');
            
            
            Route::get('/channels/add', [UserChannelsController::class, 'add'])->name('user.channels.add');
            Route::post('/channels/add', [UserChannelsController::class, 'submit'])->name('user.channels.add.submit');
            Route::get('/channels/check_tg_status', [UserChannelsController::class, 'check_tg_status'])->name('user.channels.check_tg_status');
        
        
            Route::get('/orders/in', [UserOrdersController::class, 'in_orders'])->name('user.orders.in');
            Route::post('/orders/add', [UserOrdersController::class, 'submit'])->name('user.orders.add.submit');
            Route::get('/orders/out', [UserOrdersController::class, 'out_orders'])->name('user.orders.out');
            
            Route::get('/orders/{id}/edit', [UserOrdersController::class, 'edit'])->name('user.orders.edit');
            Route::post('/orders/{id}/edit', [UserOrdersController::class, 'submit'])->name('user.orders.edit.submit');
            
            
            Route::get('/orders/{id}/{hash}/confirm', [UserOrdersController::class, 'confirm'])->name('user.orders.confirm');
            Route::get('/orders/{id}/{hash}/cancel', [UserOrdersController::class, 'cancel'])->name('user.orders.cancel');
        
            // ���������� ������ ����� ������ Dropzon    
            Route::post('/add/file',[DropzoneController::class, 'add'])->name('user.file.add');
            Route::post('/delete/file',[DropzoneController::class, 'delete'])->name('user.file.delete'); 
            
        
        
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
        
        
            Route::get('/tariffs', [AdminTariffsController::class, 'tariffs'])->name('admin.tariffs');
        
            //Route::get('/tariffs/add', [AdminTariffsController::class, 'add'])->name('admin.tariffs.add');
            Route::post('/tariffs/add/submit', [AdminTariffsController::class, 'submit'])->name('admin.tariffs.submit');
        
            Route::get('/tariffs/edit/{id}', [AdminTariffsController::class, 'edit'])->name('admin.tariffs.edit');
            Route::post('/tariffs/edit/{id}', [AdminTariffsController::class, 'save'])->name('admin.tariffs.save');
        
        
            
        });



/////////////////
        
        //Route::get('/login_tg', [TelegramController::class, 'login_tg'])->name('auth.login_tg');
        Route::get('/check_auth', [TelegramController::class, 'check_auth'])->name('auth.check_auth');
        
        
        Route::get('/test_post', [TelegramController::class, 'test_post']);
        Route::get('/del_post', [TelegramController::class, 'del_post']);
        Route::get('/autoposting', [TelegramController::class, 'autoposting']);
        Route::get('/autopostingdelete', [TelegramController::class, 'autopostingdelete']);
        
        
        
        Route::get('/get_channel_info', [TelegramController::class, 'getChannelInfo']);
        Route::get('/get_updates', [TelegramController::class, 'getUpdates']);
        
        
        Route::post('/send_message', [ChatController::class, 'sendMessage'])->name('chat.send_message');
        //Route::post('/send_message', [TelegramController::class, 'sendMessage'])->name('chat.send_message');
        //Route::get('/get_chat_messages/{order_id}', [TelegramController::class, 'getChatMessages'])->name('chat.get_chat_messages');
        


/////////////////////////////

require __DIR__.'/auth.php';

});