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
                        <div class="ch-col">
                            <a href="{{ route('user.channels.add') }}" class="channel-btn new-channel-btn">
                                <div class="icon">
                                    <?php include 'lc-styles/images/plus.svg'; 
                                    //<img src="lc-styles/images/plus.svg">
                                    ?>
                                </div>
                                <p>Додати канал</p>
                            </a>
                        </div>
                        

                        @foreach ($channels as $channel)
                        <div class="ch-col">
                            <a href="{{ route('user.channels.edit',$channel->id) }}" class="channel-btn">
                                <div class="icon">
                                    <img src="@if($channel->image)images\channels\{{$channel->image}}@else images\channels\no-image.png @endif" alt="plus">
                                </div>
                                
                                @if($channel->tg_status)
                                    <p class="green" title="Подтвержден телеграмом"><?php echo $channel->link ?></p>
                                @else
                                    <p title="Не подтвержден телеграмом"><?php echo $channel->link ?></p>
                                @endif
                                
                                
                                @if($channel->status)
                                    <p class="confirmed" title="Подтвержден администратором"></p>
                                @endif
                                
                            </a>
                        </div>                        
                        @endforeach

                       
                        
                    </div>
                    
                    
                <div class="alert alert-primary d-flex align-items-center p-5" style="margin:10px">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                    <span class="svg-icon svg-icon-2hx svg-icon-primary me-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                    <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                    </svg>
                    </span>
                    <!--end::Svg Icon-->                    
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-primary">Подтверждение прав на ваших каналах.</h4>
                        <span>Пожалуйста добавьте нашего бота <a href="https://t.me/<?php echo env('BOT_USERNAME') ?>" target="_blank">@<?php echo env('BOT_USERNAME') ?></a> в администраторы вашего канала и нажмите <a href="<?php echo route('user.channels.check_tg_status') ?>" class="btn btn-secondary me-2 mb-2">Подтвердить права</a></span>
                        <p>Если после добавления бота права не подтверждуються, попробуйте удалить бота из администраторов канала а затем добавить его повторно. Если даже после этого ваши каналы не подтверждаються, напишите о проблеме оператору в онлайн чат.</p>
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