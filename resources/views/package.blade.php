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
                
                <?php
                
                    $Page = (array) $Page;
                    $lang = App\Http\Middleware\LocaleMiddleware::getLocale();
                    if(empty($lang)) $lang = 'ua';
                ?>
                
                
                <div class="panel-main channel-new white-block">
                    <h1 class="gap-title d-flex align-items-center">
                        <p><?php echo $Page['name_'.$lang]; ?></p>
                    </h1>
                    
                    
                    @include('inc.alerts')      
                    
                    
                    
                         <div class="tariffs">   
                                <div class="packet @if($Package['popular']) packet-dark @endif">
                                    @if($Package['popular']) <div class="labe">{{ __('text.text_56') }}</div> @endif
                                    <div class="p-top">
                                        <div class="name"><?php echo $Package['name_'.$lang] ?></div>
                                        <p><?php echo $Package['short_desc_'.$lang]; ?></p>
                                    </div>
                                    <div class="p-body">
                                        <div class="for-price">
                                            <div class="price color-main">
                                                <span class="number"><?php echo $Package['price']; ?></span>{{ __('text.text_48') }}
                                            </div>
                                            <p class="txt"><?php echo __('text.text_49',['count'=>$Package['free_days']]) ?></p>
                                        </div>
                                        <div class="arrow-list">
                                            <p><span class="color-main fw-semi"><?php echo $Package['count_channels_post'] ?></span> {{ __('text.text_50') }}</p>
                                            @if($Package['delayed_posting'])<p>{{ __('text.text_51') }}</p>@endif
                                            @if($Package['buy_and_sell_adv'])<p>{{ __('text.text_52') }}</p>@endif
                                            @if($Package['creat_and_part_collections'])<p>{{ __('text.text_53') }}</p>@endif

                                            <p>{{ __('text.text_54',['count'=>$Package['withdrawals']]) }}</p>
                                            
                                            
                                            
                                        </div>
                                        
                                        
                                        
                                        <div class="plus">
                                            <?php include 'main-page/images/packet-plus.svg'; ?>
                                        </div>
                                        <div class="arrow-list">
                                        
                                            @if($Package['analytics'])<p>{{ __('text.text_62') }}</p>@endif
                                            @if($Package['instant_view_blog'])<p>{{ __('text.text_63') }}</p>@endif
                                            
                                            <p>{!! __('text.text_64',['count'=>$Package['count_sellers']]) !!}</p>
                                            
                                            @if($Package['buy_and_sell_channels'])<p>{{ __('text.text_65') }}</p>@endif

                                        </div>                                        
                                        
                                        
                                    </div>
                                    {{--
                                    <div class="p-bottom">
                                        <div class="for-btn">
                                            <a class="cl-btn big" href="">
                                                {{ __('text.text_55') }}
                                            </a>
                                        </div>
                                    </div>
                                    --}}
                                </div>
                      </div>                    
                                  
                    
                    <div class="page-content">
                
                    
                         
                   <?php echo $Package['full_desc_'.$lang]; ?>
                        
                    
                   <?php echo $Page['full_desc_'.$lang]; ?>
                    
                    </div>
                    
                    
                    @if(Auth::user())
                    
                    <div class="buy_package">
                    
                            <form action="{{ route('package.buy',$Package['id']) }}" method="post">
                                @csrf

                                <div class="for-btn text-center add-btn-wrapper">
                                    <button type="submit" class="cl-btn big">
                                        <p>{{ __('text.text_263') }}</p>
                                        <div class="icon ms-2">
                                            <?php include 'account/images/arr-top-right.svg'; ?>
                                        </div>
                                    </button>
                                </div>

                                <div class="f-row">
                                    <p>{{ __('text.text_264') }}</p>
                                </div>

                            </form>
                    
                    </div>
                    
                    @endif
                    
                </div>
                <div class="panel-banner white-block min-banner">





                                                           

                </div>                  
                

            </div>
        </div>
    </div>


    <!-- all plugins -->
    @include('inc.scripts')
    <?php //include 'scripts.php'; ?>

</body>

</html>