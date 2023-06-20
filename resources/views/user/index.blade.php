<html>

<head>

    @include('user.inc.head')

</head>

<body class="control-panel transition-off">
    <div class="wrapper">
        
        @include('user.inc.mobile-menu')
        <?php /*MOBILE MENU*/ //include 'mobile-menu.php'; ?>

        <div class="panel-inner">
            
            @include('user.inc.panel-header')
            <?php /*PANEL HEADER*/ //include 'panel-header.php'; ?>

            <div class="panel-body d-block d-xl-flex">
                
                @include('user.inc.main-menu')
                <?php /*MAIN MENU*/ //include 'main-menu.php'; ?>

                <div class="panel-main channels-content white-block">
                    <h1 class="title gap-title">Мої канали</h1>
                    <div class="channels">
                        <div class="ch-col">
                            <a href="" class="channel-btn new-channel-btn">
                                <div class="icon">
                                    <?php //include 'images/plus.svg'; ?>
                                    <img src="lc-styles/images/plus.svg">
                                </div>
                                <p>Додати канал</p>
                            </a>
                        </div>
                        <div class="ch-col">
                            <a href="" class="channel-btn">
                                <div class="icon">
                                    <img src="lc-styles/images/ch1.jpg" alt="plus">
                                </div>
                                <p>Arestovich / Official</p>
                            </a>
                        </div>
                        <div class="ch-col">
                            <a href="" class="channel-btn">
                                <div class="icon">
                                    <img src="lc-styles/images/ch2.jpg" alt="plus">
                                </div>
                                <p>Батальон “Монако”</p>
                            </a>
                        </div>
                        <div class="ch-col">
                            <a href="" class="channel-btn">
                                <div class="icon">
                                    <img src="lc-styles/images/ch3.jpg" alt="plus">
                                </div>
                                <p>Ukraine NOW</p>
                            </a>
                        </div>
                        <div class="ch-col">
                            <a href="" class="channel-btn">
                                <div class="icon">
                                    <img src="lc-styles/images/ch3.jpg" alt="plus">
                                </div>
                                <p>Ukraine NOW</p>
                            </a>
                        </div>
                        <div class="ch-col">
                            <a href="" class="channel-btn">
                                <div class="icon">
                                    <img src="lc-styles/images/ch3.jpg" alt="plus">
                                </div>
                                <p>Ukraine NOW</p>
                            </a>
                        </div>
                        <div class="ch-col">
                            <a href="" class="channel-btn">
                                <div class="icon">
                                    <img src="lc-styles/images/ch3.jpg" alt="plus">
                                </div>
                                <p>Ukraine NOW</p>
                            </a>
                        </div>
                        <div class="ch-col">
                            <a href="" class="channel-btn">
                                <div class="icon">
                                    <img src="lc-styles/images/ch3.jpg" alt="plus">
                                </div>
                                <p>Ukraine NOW</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-banner white-block min-banner">
                    <div class="video-block">
                        <div class="video-bl" data-video="zpOULjyy-n8"></div>
                        <div class="text">
                            <p><span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo, aliquid cumque. Eligendi velit incidunt animi doloribus alias similique ad, aliquid quam</span></p>
                            <p><span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo, aliquid cumque. Eligendi velit incidunt animi doloribus alias similique ad, aliquid quam</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- all plugins -->
    @include('user.inc.scripts')
    <?php //include 'scripts.php'; ?>

</body>

</html>