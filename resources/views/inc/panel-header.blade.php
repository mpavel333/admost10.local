<div class="panel-header d-none d-xl-flex">
    <div class="h-col min-banner">
        <div class="logo">
            <a href="{{ route('index') }}">
                <img src="lc-styles/images/logo.svg" alt="logo">
            </a>
        </div>
    </div>
    <div class="h-col for-tech-menu flex-grow-1">
        <div class="tech-menu tech-menu-move">
            @if(Auth::user())
                <div class="link">
                    <a class="{{ (request()->is('user/publication')) ? 'active' : '' }}" href="{{route('user.publications.add')}}">{{ __('text.text_108') }}</a>
                </div>
            @endif
            <div class="link">
                <a class="{{ (request()->is('channels') OR request()->is('channel/*')) ? 'active' : '' }}" href="{{route('channels')}}">{{ __('text.text_2') }}</a>
            </div>
            <div class="link">
                <a href="#">{{ __('text.text_53') }}</a>
            </div>
            <div class="link">
                <a href="#">{{ __('text.text_109') }}</a>
            </div>
            <div class="link">
                <a href="#">{{ __('text.text_110') }}</a>
            </div>
        </div>
    </div>
    <div class="h-col h-settings">


        @if(Auth::guest())

        <!-- controls desktop -->
        <div class="col-auto d-none d-md-block">
            <div class="control-buttons d-flex column-gap-2">

                <div class="for-btn">
                    <a href="{{ route('login') }}" class="login cl-btn blue-l-btn">
                        <div class="icon">
                            <?php include 'main-page/images/login.svg'; 
                            //<img src="main-page/images/login.svg">
                            ?>
                            
                        </div>
                        <p>{{ __('text.text_6') }}</p>
                    </a>
                </div>
                <div class="for-btn">
                    <a href="{{ route('register') }}" class="login cl-btn">
                        <div class="icon">
                            <?php include 'main-page/images/plus.svg'; 
                            //<img src="main-page/images/plus.svg">
                            ?>
                        </div>
                        <p>{{ __('text.text_7') }}</p>
                    </a>
                </div>                

            </div>
        </div>

        @endif

    
    @if(Auth::user())
    
        <a href="{{route('user.balance.index')}}" class="balance balance-move cl-btn blue-l-btn cl-dark">
            <p class="flex-grow-1">{{ __('text.text_112') }}: <span class="fw-bold">{{Auth::user()->balance}} {{ __('text.text_20') }}</span></p>
            <div class="icon ms-2">
                <?php include 'lc-styles/images/plus.svg'; ?>
            </div>
        </a>
        <div class="languages languages-move dropdown-link">
            <div class="current icon">
            
            <?php
            
            $lang = App\Http\Middleware\LocaleMiddleware::getLocale(); 
            
                
            switch ($lang) {
                case "ua":
                    echo '<img src="metronik/assets/media/flags/ukraine.svg" alt="flag">';
                    break;
                case "ru":
                    echo '<img src="metronik/assets/media/flags/russia.svg" alt="flag">';
                    break;
                case "en":
                    echo '<img src="metronik/assets/media/flags/united-states.svg" alt="flag">';
                    break;
            }
                            
                
            ?>
            
            </div>
            <div class="lang-dropdown dropdown-default">
                <div class="dropdown-inner">
                    
                  
                    
                    <a href="<?= route('setlocale', ['lang' => 'ua']) ?>" class="icon ua">
                        <img src="metronik/assets/media/flags/ukraine.svg" alt="flag">
                    </a>
                    
                    <a href="<?= route('setlocale', ['lang' => 'ru']) ?>" class="icon ru">
                        <img src="metronik/assets/media/flags/russia.svg" alt="flag">
                    </a>
                    
                    <a href="<?= route('setlocale', ['lang' => 'en']) ?>" class="icon usa">
                        <img src="metronik/assets/media/flags/united-states.svg" alt="flag">
                    </a>
                    
                    
                    
                    
                </div>
            </div>
        </div>
        <div class="notification notification-move fill-inherit">
            <a href="{{route('user.report.index')}}"><?php include 'lc-styles/images/bell.svg'; ?><?php echo ($report_new_messages>0)? '<span class="new_rep_mes">'.$report_new_messages.'</span>' : '' ?></a>
        </div>
        <div class="account-menu account-move dropdown-link">
            <div class="current">
                <div class="name">ДД</div>
                <div class="avatar d-none">
                    <img src="lc-styles/images/user.webp" alt="avatar">
                </div>
            </div>
            <div class="account-dropdown dropdown-default">
                <div class="dropdown-inner">
                    <div class="link">
                        <a href="#">{{ __('text.text_111') }}</a>
                    </div>
                    <div class="link">
                        <a href="{{ route('logout') }}">{{ __('text.text_10') }}</a>
                    </div>

                </div>
            </div>
        </div>
        
        @endif
        
    </div>
</div>