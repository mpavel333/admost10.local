<html>

<head>

    @include('inc.head')

</head>

<body class="control-panel transition-off">
    <div class="wrapper">
        
        @include('inc.mobile-menu')
        <?php /*MOBILE MENU*/ //include 'mobile-menu.php'; ?>

        <div class="panel-inner">
            
            @include('inc.panel-header')
            <?php /*PANEL HEADER*/ //include 'panel-header.php'; ?>




            <div class="panel-body d-block d-xl-flex">
                
                @include('inc.main-menu')
                <?php /*MAIN MENU*/ //include 'main-menu.php'; ?>

                <div class="panel-main channels-content white-block">
                    <h1 class="title gap-title">Каталог каналов</h1>


                    
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif                    
                    
            @if (\Session::has('error'))
                <div class="alert alert-error">
                    <ul>
                        <li>{!! \Session::get('error') !!}</li>
                    </ul>
                </div>
            @endif                    
                    <div class="channels">
                        

                        @foreach ($channels as $channel)
                        <div class="ch-col">
                            <a href="{{ route('channels.channel',$channel->id) }}" class="channel-btn">
                                <div class="icon">
                                    <img src="lc-styles/images/ch1.jpg" alt="plus">
                                </div>
                                <p @if($channel->tg_status) style="color:green;" @endif><?php echo $channel->link ?></p>
                            </a>
                        </div>                        
                        @endforeach

                        
                        
                        
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
    @include('inc.scripts')
    <?php //include 'scripts.php'; ?>

</body>

</html>