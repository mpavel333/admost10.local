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
                    <a class="{{ (request()->is('user/publication')) ? 'active' : '' }}" href="{{route('user.publications.add')}}">Відкладена публікація</a>
                </div>
            @endif
            <div class="link">
                <a class="{{ (request()->is('channels') OR request()->is('channel/*')) ? 'active' : '' }}" href="{{route('channels')}}">Каталог каналів</a>
            </div>
            <div class="link">
                <a href="#">Участь у добірках</a>
            </div>
            <div class="link">
                <a href="#">Купівля/продаж кналів</a>
            </div>
            <div class="link">
                <a href="#">Вакансії</a>
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
                        <p>Увійти</p>
                    </a>
                </div>
                <div class="for-btn">
                    <a href="{{ route('register') }}" class="login cl-btn">
                        <div class="icon">
                            <?php include 'main-page/images/plus.svg'; 
                            //<img src="main-page/images/plus.svg">
                            ?>
                        </div>
                        <p>Приєднатися</p>
                    </a>
                </div>                

            </div>
        </div>

        @endif

    
    @if(Auth::user())
    
        <a href="{{route('user.balance.index')}}" class="balance balance-move cl-btn blue-l-btn cl-dark">
            <p class="flex-grow-1">Баланс: <span class="fw-bold">{{Auth::user()->balance}} грн</span></p>
            <div class="icon ms-2">
                <?php include 'lc-styles/images/plus.svg'; ?>
            </div>
        </a>
        <div class="languages languages-move dropdown-link">
            <div class="current icon">
                <img src="lc-styles/images/flag.svg" alt="flag">
            </div>
            <div class="lang-dropdown dropdown-default">
                <div class="dropdown-inner">
                    <a href="" class="icon">
                        <img src="lc-styles/images/flag.svg" alt="flag">
                    </a>
                </div>
            </div>
        </div>
        <div class="notification notification-move fill-inherit">
            <?php include 'lc-styles/images/bell.svg'; ?>
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
                        <a href="#">Налаштування</a>
                    </div>
                    <div class="link">
                        <a href="{{ route('logout') }}">Вихід</a>
                    </div>

                </div>
            </div>
        </div>
        
        @endif
        
    </div>
</div>