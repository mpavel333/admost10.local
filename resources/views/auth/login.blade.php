<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
    
    
    <div class="login-telegram" style="border: 1px solid black; padding: 10px; margin-top: 20px;">      
                
                
                <p><b>Авторизация через телеграм</b></p>
                
                <br />
<?php


function getTelegramUserData() {
  if (isset($_COOKIE['tg_user'])) {
    $auth_data_json = urldecode($_COOKIE['tg_user']);
    $auth_data = json_decode($auth_data_json, true);
    return $auth_data;
  }
  return false;
}

$tg_user = getTelegramUserData();

if (!$tg_user) {

echo '<script async src="https://telegram.org/js/telegram-widget.js?2" data-telegram-login="'.env('BOT_USERNAME').'" data-size="large" data-auth-url="/check_auth"></script>';

}
/*
if (isset($_GET['logout'])) {
  setcookie('tg_user', '');
  header('Location: login_example.php');
}
*/
/*
$tg_user = getTelegramUserData();

if ($tg_user !== false) {
$first_name = htmlspecialchars($tg_user['first_name']);
//$last_name = htmlspecialchars($tg_user['last_name']);
$last_name = '';
if (isset($tg_user['username'])) {
$username = htmlspecialchars($tg_user['username']);
$html = "<h1>Hello, <a href=\"https://t.me/{$username}\">{$first_name} {$last_name}</a>!</h1>";
} else {
$html = "<h1>Hello, {$first_name} {$last_name}!</h1>";
}
if (isset($tg_user['photo_url'])) {
$photo_url = htmlspecialchars($tg_user['photo_url']);
$html .= "<img src=\"{$photo_url}\">";
}
$html .= "<p><a href=\"?logout=1\">Log out</a></p>";
} else {
    $bot_username = BOT_USERNAME;
    $html = <<<HTML
    <h1>Hello, anonymous!</h1>
    <script async src="https://telegram.org/js/telegram-widget.js?2" data-telegram-login="{$bot_username}" data-size="large" data-auth-url="/check_auth"></script>
HTML;
}


  echo 'HTML
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login Widget Example</title>
  </head>
  <body><center>'.$html.'</center></body>
</html>
HTML';                
                
  */              
                
                
?>                
                
                
                
                
                
                
        <?php /*        
                
                
                ------------
                          
                <p>Способ 1: Для авторизации перейдите по ссылке <a href="http://cflink.ru/admost333_bot?start=<?php echo $random; ?>" target="_blank"><i class="fa fa-telegram" aria-hidden="true"></i> admost333_bot</a> и нажмите "Start".</p>
                <br />
                <p>Способ 2: Для авторизации отправьте боту <a href="http://cflink.ru/admost333_bot" target="_blank"><i class="fa fa-telegram" aria-hidden="true"></i> admost333_bot</a> следующий текст (кликните, чтобы скопировать в буфер обмена):</p>
                
                <p>/start <?php echo $random; ?></p>              


                <script type="text/javascript">
                
                
                function checkAuth() {
                
                    const url = '/check_auth';
                    
                    let data = new FormData();
                    
                    data.append("_token", '<?php echo csrf_token(); ?>')
                    data.append("key", '<?php echo $random; ?>')
                
                    const requestOptions = {
                        method: "POST",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                        },
                        body: data,
                        redirect: "follow",
                    }
                
                    fetch(url, requestOptions)
                        .then((response) => {
                            if (response.status >= 200 && response.status < 300) {
                                return Promise.resolve(response)
                            } else {
                                return Promise.reject(new Error(response.statusText))
                            }
                        })
                        .then((response) => {
                            return response.json()
                        })
                        .then((data) => {
                            
                            if (data.result == "ok") {
                                
                                window.location.href = "{{ route('user.index') }}";
                                
                                //error.style = "display: none"
                                //submit && submit.setAttribute("disable", false)
                                //form.classList.add("d-none")
                                //success.style = "display: block"
                            } else {
                                //error.style = "display: block"
                            }
                            
                        
                        })
                        .catch((err) => {
                            //error.style = "display: block"
                            //console.error("Request failed", err)
                        })    
                    
                    }
                    
                    
                    //setInterval(checkAuth, 2000);
                    
                
                </script>    
                
                <?php */ ?>
    
    </div>    
    
    
    
    
    
    
    
</x-guest-layout>
