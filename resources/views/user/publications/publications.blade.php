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



                
                <div class="panel-main orders white-block">
                
                @include('inc.alerts')
                
                    <h1 class="title gap-title">
                        <p>{{ __('text.text_114') }}</p> 
                    </h1>
                    
                    
                    
                    <div class="orders-inner">
                    
                    @if(Auth::user()->getUserPackage)
                    
                    <div class="tariff_info"> 
                        <p>Ваш тариф: {{ Auth::user()->PackageInfo()->name_ua }} </p>
                        <p>Старт: {{ Auth::user()->getUserPackage->date_start }} </p>
                        <p>Завершение: {{ Auth::user()->getUserPackage->date_end }} </p>
                        @if(Auth::user()->PackageInfo()->delayed_posting)
                        <p>Количество каналов для отложенного постинга: ({{ $published }}/{{ Auth::user()->PackageInfo()->count_channels_post }}) </p>
                        @endif
                    </div>
                    
                    @endif
                    
                        <div class="collapses">
                        
        @foreach ($publications as $publication)


        <div class="collapse-block @if($publication->status==1) in_work @elseif($publication->status==2) stopped @endif ">
            <button class="btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order-{{$publication->id}}">
                <div class="c-block cbl-1">
                    <div class="channel-order-info">
                   
                       @foreach ($publication->channels as $channel)
                    
                        <div class="pic">
                            <img src="@if($channel->image)images\channels\{{$channel->image}}@else images\channels\no-image.png @endif" alt="pic">
                            <div class="notification-count gray"></div>
                        </div>

                        <div class="main-info">
                            <div class="name-row">
                                <div class="name">
                                    {{ $channel->name }}
                                </div>
                                <div class="icon">
                                   
                                </div>
                            </div>
                        </div>
                            
                       @endforeach    
                   
                    </div>
                </div>
                <div class="c-block cbl-2">
                    <div class="number-block">
                        <p>{{ __('text.text_145') }}</p>
                        <div class="number"><?php echo date('d.m.Y',strtotime($publication->date_published)) ?></div>
                    </div>
                    <div class="number-block">
                        <p>{{ __('text.text_146') }}</p>
                        <div class="number"><?php echo date('H:i',strtotime($publication->date_published)) ?></div>
                    </div>
                </div>
                
                @if($publication->date_repeat)
                <div class="c-block cbl-3">
                    <div class="number-block">
                        <p>{{ __('text.text_147') }}</p>
                        <div class="number"><?php echo date('d.m.Y',strtotime($publication->date_repeat)) ?></div>
                    </div>
                    <div class="number-block">
                        <p>{{ __('text.text_148') }}</p>
                        <div class="number"><?php echo date('H:i',strtotime($publication->date_repeat)) ?></div>
                    </div>
                </div>
                @endif
                
                <div class="c-block cbl-4">
                    <div class="other-info">
                        <p>{{$publication->created_at}}</p>
                        <p>№{{$publication->id}}</p>
                    </div>
                </div>
            </button>
            <div class="collapse" id="order-{{$publication->id}}">
                <div class="card">
                    <div class="collapse-content">
                        <div class="c-block cbl-1">
                            <div class="for-text">
                                <div class="tit">{{ __('text.text_149') }}</div>
                                <div class="text">
                                    <p>{{ $publication->message }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="c-block cbl-2">
                            <div class="tech-task">
                                <div class="tit">{{ __('text.text_150') }}</div>
                                <div class="text">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="c-block cbl-3">
                            <div class="tit">{{ __('text.text_151') }}</div>
                            <div class="copy-block" data-success="{{ __('text.text_152') }}">
                                <input value="{{ $publication->link }}" type="text" readonly>
                                <div class="icon">
                                    <img src="images/copy-icon.svg" alt="copy">
                                </div>
                            </div>
                        </div>
                        <div class="c-block cbl-4">
                            <div class="preview-pic-btn" data-bs-toggle="modal" data-bs-target="#preview-modal-{{$publication->id}}">
                            <?php //print_r($publication); ?>
                                <img src="@if($publication->images[0]){{$publication->images[0]->path}}/{{$publication->images[0]->filename}}@else images\channels\no-image.png @endif" alt="preview">
                                <div class="icon preview-icon fill-inherit">
                                    <?php include 'images/eye.svg'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse-buttons">
                        <div class="for-btn">
                        @if($publication->status==1)
                            <a class="cl-btn btn-success">{{ __('text.text_153') }}</a>
                        @endif
                        @if($publication->status!=1)
                            <a class="cl-btn" href="<?php echo route('user.publications.published',['id'=>$publication->id,'hash'=>hash('sha256', $publication->id.env('ORDERS_SOLT'))]) ?>">
                                {{ __('text.text_154') }}
                            </a>
                        @endif
                        </div>
                        <div class="for-btn">
                        @if($publication->status!=0)
                            <a class="cl-btn deny-btn" href="<?php echo route('user.publications.cancel',['id'=>$publication->id,'hash'=>hash('sha256', $publication->id.env('ORDERS_SOLT'))]) ?>">
                                {{ __('text.text_155') }}
                            </a>
                        @endif
                        </div>

                        <div class="for-btn">
                            <a class="cl-btn cl-btn blue-l-btn open-chat" href="<?php echo route('user.publications.edit',$publication->id) ?>">
                                <p>{{ __('text.text_156') }}</p>
                            </a>
                        </div>
                    </div>
                    
                    @if($publication->status)
                    <div class="collapse-message">
                        <strong>{{ __('text.text_157') }}:</strong>
                    
                    
                        @switch($publication->status)
                            @case(1)
                                <span>{{ __('text.text_158') }}</span>
                                @break
                            
                            @case(2)
                                <span>{{ __('text.text_159') }}</span>
                                @break
                            
                            @default
                        
                        @endswitch                   
                    
                    </div>
                    
                    @endif
                    
                    
                    
                </div>
            </div>
        </div>
        
        


<!-- Preview modal -->
<div class="modal fade preview-modal min-modal" id="preview-modal-{{$publication->id}}" tabindex="-1" role="dialog" ,aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="preview-inner">
                <div class="title min-offset">{{ __('text.text_160') }}</div>
                <div class="modal-blocks min-offset">
                    <div class="modal-block">
                        <div class="pic">
                            <img src="{{$publication->images[0]->path}}/{{$publication->images[0]->filename}}" alt="preview">
                        </div>
                    </div>
                    <div class="modal-block">
                        <div class="text content-scroll">
                            <p>{{ $publication->message }}</p>
                        </div>
                    </div>
                    <div class="modal-block">
                        <div class="copy-block" data-success="{{ __('text.text_152') }}">
                            <input value="{{ $publication->link }}" type="text" readonly>
                            <div class="icon">
                                <img src="images/copy-icon.svg" alt="copy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Preview modal -->






@endforeach


{{ $publications->render() }}


<script type="text/javascript">
    const ws = new WebSocket('ws://<?php echo env('WEBSOCKET'); ?>');
    var user_id = <?php echo Auth::user()->id ?>;
</script>

<script src="lc-styles/js/chats.js"></script>

                            
                        </div>
                    </div>
                </div>                
                
                <div class="panel-banner white-block min-banner">

                </div>                  
                

            </div>
        </div>
    </div>
    
    
    @include('inc.modals')
    
    <!-- all plugins -->
    @include('inc.scripts')
    <?php //include 'scripts.php'; ?>

    

</body>

</html>