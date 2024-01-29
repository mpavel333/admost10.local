<!DOCTYPE HTML>
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

                <div class="panel-main filters white-block">
                    <h1 class="title gap-title">{{ __('text.text_261') }}</h1>
     
                    
                    <div class="filter-results">
                    
                    @foreach ($channels as $channel)

                        <div class="result-row">
                            <div class="r-block rbl-1">
                                <div class="channel-order-info">
                                    <div class="pic">
                                        <img src="@if($channel->image)images\channels\{{$channel->image}}@else images\channels\no-image.png @endif" alt="pic">
                                        @if(Auth::user())
                                        <div class="favorite @if($channel->favorite_status==1) active @endif" id="favorite-{{$channel->id}}" data-id="{{$channel->id}}">
                                            <?php include 'images/favorite.svg'; ?>
                                        </div>
                                        <div class="blacklist @if($channel->favorite_status==2) active @endif" id="blacklist-{{$channel->id}}" data-id="{{$channel->id}}">
                                            <?php include 'account/images/m5.svg'; ?>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="main-info">
                                        <div class="name-row">
                                            <div class="name">
                                                {{$channel->name}}
                                            </div>
                                            <div class="icon">
                                                <img src="images/verified.svg" alt="verified">
                                            </div>
                                        </div>
                                        <div class="lead-time">
                                            {{$channel->category_name}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="r-block rbl-2">
                                <div class="number-block">
                                    <p>{{ __('text.text_253') }}</p>
                                    <div class="number"><?php 
                                    $subscribers = $channel->subscribers;
                                    if($subscribers>1000) $subscribers = ($channel->subscribers / 1000).'K';
                                    echo $subscribers;
                                    ?></div>
                                </div>
                                <div class="number-block">
                                    <p>{{ __('text.text_252') }}</p>
                                    <div class="number">{{$channel->er}}%</div>
                                </div>
                                <div class="number-block">
                                    <p>{{ __('text.text_258') }}</p>
                                    <div class="number">
                                    <?php
                                    $views = $channel->views;
                                    if($views>1000) $views = ($channel->views / 1000).'K';
                                    echo $views;                                    
                                    ?>
                                    </div>
                                </div>
                                <div class="number-block">
                                    <p>{{ __('text.text_254') }}</p>
                                    <div class="number">{{$channel->cpv}}<span class="currency"></span></div>
                                </div>
                            </div>
                            <div class="r-block rbl-3">
                               <div class="number-block">
                                    <p>{{ __('text.text_225') }}</p>
                                    <div class="number arr-number">
                                        @foreach($channel->tariff as $item)
                                        {{$item->format}}
                                        @endforeach
                                        <img src="images/arr-down.svg" alt="arr">
                                    </div>
                                </div>
                                <div class="number-block">
                                    <p>{{ __('text.text_226') }}</p>
                                    @foreach($channel->tariff as $item)
                                    <div class="number">{{$item->price}}<span class="currency">{{ __('text.text_20') }}</span></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="r-block rbl-4">
                                <div class="controls">
                                    <div class="link">
                                        <a href="{{ route('channels.channel',$channel->id) }}">
                                            <p>{{ __('text.text_260') }}</p>
                                            <div class="icon fill-inherit">
                                                <?php include 'images/arr-link.svg'; ?>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="favorite">
                                        <?php include 'images/favorite.svg'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach     
                        
                    </div>                    
                    
                    <div class="filter-paginate">
                    <?php echo $channels->appends($form)->links(); ?>
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
    <?php 
    //@include('user.inc.scripts')
    //include 'scripts.php'; ?>

</body>

</html>