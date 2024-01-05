<div class="panel-header d-none d-xl-flex">
    <div class="h-col min-banner">
        <div class="logo">
            <a href="{{ route('index') }}">
                <?php include 'lc-styles/images/logo.svg'; 
                //<img src="lc-styles/images/logo.svg" alt="logo">
                ?>
            </a>
        </div>
    </div>
    <div class="h-col for-tech-menu flex-grow-1">
        <div class="tech-menu tech-menu-move">
            <div class="link">
                <a class="active" href="{{route('user.publications.add')}}">Відкладена публікація</a>
            </div>
            <div class="link">
                <a href="{{route('channels')}}">Каталог каналів</a>
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
        <a class="balance balance-move cl-btn blue-l-btn cl-dark">
            <p class="flex-grow-1">Баланс: <span class="fw-bold">10 233 грн</span></p>
            <div class="icon ms-2">
                
                <?php include 'lc-styles/images/plus.svg'; 
                
                //<img src="lc-styles/images/plus.svg"/>
                ?>
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
            
            <?php include 'lc-styles/images/bell.svg'; 
            
            //<img src="lc-styles/images/bell.svg"/>
            ?>
            
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
    </div>
</div>