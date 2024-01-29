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
                    

                    <div class="filter-line">
                        <form id="form_search" action="{{ route('channels') }}" method="get">
                            <div class="filter-search">
                                <input class="form-control" placeholder="{{ __('text.text_248') }}" name="name" value="{{ old('name') }}">
                                <div class="icon">
                                    <img src="images/search.svg" alt="search">
                                </div>
                            </div>
                            <div class="filter-dropdowns d-none d-xl-block">
                                <div class="filter-move">
                                    
                                    <?php
                                        $form_categories = [];
                                        if($form['category']) $form_categories = explode(',',$form['category']);
                                        
                                        $form_format = [];
                                        if($form['format']) $form_format = explode(',',$form['format']);
                                    ?>
                                    
                                    <div class="multiple-select category select-dropdown-link dropdown-link mobile-slide">
                                        <input name="category" type="hidden" class="select-input" value="<?php //echo $form['category'] ?>">
                                        
                                        <div class="control-select <?php //echo ($count)? 'active' : '' ?>">
                                            <div class="choosen-block">
                                                <div class="choosen-txt">{{ __('text.text_17') }}</div>
                                                <div class="notification-count <?php //echo ($count)? 'active' : '' ?>"><?php //echo ($count)? $count : '' ?></div>
                                            </div>
                                            <div class="arrow fill-inherit">
                                                <?php include 'images/arr-down.svg'; ?>
                                            </div>
                                        </div>
                                        <div class="select-dropdown dropdown-default">
                                            <div class="dropdown-inner">
                                                <div class="choosen-list <?php //echo ($count)? 'active' : '' ?>">
                                                    <div class="tit">{{ __('text.text_249') }}</div>
                                                    <div class="choosen-wrapper deleting-blocks"></div>
                                                </div>
                                                <div class="select-list multiple-select-list">
                                                    
                                                    <?php
                                                    foreach ($categories as $category):
                                                        $active = '';
                                                        if(in_array($category->id,$form_categories)) $active = 'active';
                                                        echo '<div id="select-point-'.$category->id.'" class="select-point '.$active.'" data-val="'.$category->id.'">'.$category->name.'</div>';
                                                    endforeach
                                                    ?>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <script type="text/javascript">
                                            
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const list_point_active = document.querySelectorAll('.multiple-select-list .select-point.active');
                                            
                                                if (list_point_active) {
                                                    list_point_active.forEach(function (item) {
                                                        item.click();
                                                    });
                                                }

                                                const single_point_active = document.querySelector('.single-select .select-point.active');
                                                if (single_point_active) single_point_active.click();

                                            });                                            
                                            
                                        </script>
                                    </div>
                                    
                                    
                                    <div class="multiple-select select-dropdown-link dropdown-link mobile-slide">
                                        <input name="format" type="hidden" class="select-input">
                                        <div class="control-select">
                                            <div class="choosen-block">
                                                <div class="choosen-txt">{{ __('text.text_225') }}</div>
                                                <div class="notification-count">0</div>
                                            </div>
                                            <div class="arrow fill-inherit">
                                                <?php include 'images/arr-down.svg'; ?>
                                            </div>
                                        </div>
                                        <div class="select-dropdown dropdown-default">
                                            <div class="dropdown-inner">
                                                <div class="choosen-list">
                                                    <div class="tit">{{ __('text.text_249') }}</div>
                                                    <div class="choosen-wrapper deleting-blocks"></div>
                                                </div>
                                                <div class="select-list multiple-select-list">

                                                    <?php
                                                    foreach ($tariffs as $tariff):
                                                        $active = '';
                                                        if(in_array($tariff->id,$form_format)) $active = 'active';
                                                        echo '<div id="select-point-'.$tariff->id.'" class="select-point '.$active.'" data-val="'.$tariff->id.'">'.$tariff->format.'</div>';
                                                    endforeach
                                                    ?>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-select select-dropdown-link dropdown-link mobile-slide">
                                        <input name="sort" type="hidden" class="select-input">
                                        <div class="control-select">
                                            <div class="choosen-block">
                                                <div class="choosen-txt">{{ __('text.text_250') }}</div>
                                            </div>
                                            <div class="arrow fill-inherit">
                                                <?php include 'images/arr-down.svg'; ?>
                                            </div>
                                        </div>
                                        <div class="select-dropdown dropdown-default">
                                            <div class="dropdown-inner">
                                                <div class="select-list">
                                                
                                                <?php
                                                    foreach ($categories as $category):
                             
                                                        $active = '';
                                                        if($category->id == $form['sort']) $active = 'active';
                                                        
                                                        if(!empty($form_categories) && in_array($category->id,$form_categories)){
                                                            echo '<div id="select-point-'.$category->id.'" class="select-point '.$active.'" data-val="'.$category->id.'">'.$category->name.'</div>';
                                                        }elseif(empty($form_categories)){
                                                            echo '<div id="select-point-'.$category->id.'" class="select-point '.$active.'" data-val="'.$category->id.'">'.$category->name.'</div>';
                                                        }
                                                    endforeach
                                                ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="select-dropdown-link dropdown-link range-dropdown-link mobile-slide">
                                        <div class="control-select @if($form['er']) active @endif">
                                            <div class="choosen-block">
                                                <div class="choosen-txt">{{ __('text.text_251') }}</div>
                                            </div>
                                            <div class="arrow fill-inherit">
                                                <?php include 'images/arr-down.svg'; ?>
                                            </div>
                                        </div>
                                        <div class="select-dropdown range-dropdown dropdown-default">
                                            <div class="dropdown-inner">
                                                <div class="range-filter">
                                                    <div class="tit">{{ __('text.text_252') }},%</div>
                                                    <?php $er = explode(';',$form['er']) ?>
                                                    <input type="text" class="range-input" name="er" value="<?php echo $form['er'] ?>" data-type="double" data-min="0" data-max="100" data-from="<?php echo $er[0] ?>" data-to="<?php echo $er[1] ?>" data-grid="false" />
                                                    <div class="from-to">
                                                        <div class="inputblock">
                                                            <p>{{ __('text.text_256') }}</p>
                                                            <input placeholder="0" type="text" value="<?php echo $er[0] ?>" class="form-control range-from">
                                                        </div>
                                                        <div class="inputblock">
                                                            <p>{{ __('text.text_257') }}</p>
                                                            <input placeholder="100" type="text" value="<?php echo $er[1] ?>" class="form-control range-to">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="range-filter">
                                                    <div class="tit">{{ __('text.text_253') }}</div>
                                                    <?php $subscribers = explode(';',$form['subscribers']) ?>
                                                    <input type="text" class="range-input" name="subscribers" value="<?php echo $form['subscribers'] ?>" data-type="double" data-min="0" data-max="2000000" data-from="<?php echo $subscribers[0] ?>" data-to="<?php echo $subscribers[1] ?>" data-grid="false" />
                                                    <div class="from-to">
                                                        <div class="inputblock">
                                                            <p>{{ __('text.text_256') }}</p>
                                                            <input placeholder="100" type="text" value="<?php echo $subscribers[0] ?>" class="form-control range-from">
                                                        </div>
                                                        <div class="inputblock">
                                                            <p>{{ __('text.text_257') }}</p>
                                                            <input placeholder="2000000" type="text" value="<?php echo $subscribers[1] ?>" class="form-control range-to">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="range-filter">
                                                    <div class="tit">{{ __('text.text_254') }}</div>
                                                    <?php $cpv = explode(';',$form['cpv']) ?>
                                                    <input type="text" class="range-input" name="cpv" value="<?php echo $cpv ?>" data-type="double" data-min="0" data-max="20000" data-from="<?php echo $cpv[0] ?>" data-to="<?php echo $cpv[1] ?>" data-grid="false" />
                                                    <div class="from-to">
                                                        <div class="inputblock">
                                                            <p>{{ __('text.text_256') }}</p>
                                                            <input placeholder="100" type="text" value="<?php echo $cpv[0] ?>" class="form-control range-from">
                                                        </div>
                                                        <div class="inputblock">
                                                            <p>{{ __('text.text_257') }}</p>
                                                            <input placeholder="20 000" type="text" value="<?php echo $cpv[1] ?>" class="form-control range-to">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{--
                            <div id="form_search_timer"><span>3</span></div>
                            --}}  
                            
                            <button class="button_search cl-btn" type="submit">{{ __('text.text_248') }}</button>
                            
                            <div class="filter-btn d-xl-none" data-bs-toggle="modal" data-bs-target="#filters-modal">
                                <p>{{ __('text.text_255') }}</p>
                                <div class="icon">
                                    <img src="images/filter.svg" alt="filter">
                                </div>
                            </div>
                        </form>
                    </div>
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

                </div>
            </div>
        </div>
    </div>

    <!-- all plugins -->
    @include('inc.scripts')
    <?php //include 'scripts.php'; ?>

</body>

</html>