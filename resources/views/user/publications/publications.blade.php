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
                        <p>Мои публикации </p> 
                    </h1>
                    
                    <div class="orders-inner">
                        <div class="collapses">
                        
@foreach ($publications as $publication)


        <div class="collapse-block">
            <button class="btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order-{{$publication->id}}">
                <div class="c-block cbl-1">
                    <div class="channel-order-info">
                   
                   
                   <?php //print_r($publications) ?>
                   
                  
                    
                    
                    <?php //print_r($publications->channels) ?>
                    
                    
                       @foreach ($publication->channels as $channel)
                        
                            <div class="pic">
                                <img src="@if($channel->image)images\channels\{{$channel->image}}@else images\channels\no-image.png @endif" alt="pic">
                                <div class="notification-count gray">3</div>
                            </div>
                            
                       @endforeach    
                   
                  
                        
                        <div class="main-info">
                            <div class="name-row">
                                <div class="name">
                                    {{ $publication->channel_name }}
                                </div>
                                <div class="icon">
                                    <img src="images/verified.svg" alt="verified">
                                </div>
                            </div>
                            <div class="lead-time">
                                Час на виконання <span>18:38:25</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="c-block cbl-2">
                    <div class="number-block">
                        <p>Формат</p>
                        <div class="number">1/24</div>
                    </div>
                    <div class="number-block">
                        <p>Ціна</p>
                        <div class="number price">3 000<span class="currency">грн</span></div>
                    </div>
                </div>
                <div class="c-block cbl-3">
                    <div class="number-block">
                        <p>Дата публікації</p>
                        <div class="number">{{$publication->published}}</div>
                    </div>
                    <div class="number-block">
                        <p>Час публікації</p>
                        <div class="number">10:00 - 19:00</div>
                    </div>
                </div>
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
                                <div class="tit">Рекламний текст</div>
                                <div class="text">
                                    <p>{{ $publication->message }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="c-block cbl-2">
                            <div class="tech-task">
                                <div class="tit">ТЗ від замовника</div>
                                <div class="text">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="c-block cbl-3">
                            <div class="tit">Рекламне посилання</div>
                            <div class="copy-block" data-success="Скопійовано!">
                                <input value="{{ $publication->link }}" type="text" readonly>
                                <div class="icon">
                                    <img src="images/copy-icon.svg" alt="copy">
                                </div>
                            </div>
                        </div>
                        <div class="c-block cbl-4">
                            <div class="preview-pic-btn" data-bs-toggle="modal" data-bs-target="#preview-modal-{{$publication->id}}">
                                <img src="{{$publication->images[0]->path}}/{{$publication->images[0]->filename}}" alt="preview">
                                <div class="icon preview-icon fill-inherit">
                                    <?php include 'images/eye.svg'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse-buttons">
                        <div class="for-btn">
                        @if($publication->status==1)
                            <a class="cl-btn btn-success">Пост опубликован</a>
                        @endif
                        @if($publication->status!=1)
                            <a class="cl-btn" href="<?php echo route('user.publications.published',['id'=>$publication->id,'hash'=>hash('sha256', $publication->id.env('ORDERS_SOLT'))]) ?>">
                                Публиковать
                            </a>
                        @endif
                        </div>
                        <div class="for-btn">
                        @if($publication->status!=0)
                            <a class="cl-btn deny-btn" href="<?php echo route('user.publications.cancel',['id'=>$publication->id,'hash'=>hash('sha256', $publication->id.env('ORDERS_SOLT'))]) ?>">
                                Снять с публикации
                            </a>
                        @endif
                        </div>

                        <div class="for-btn">
                            <a class="cl-btn cl-btn blue-l-btn open-chat" href="<?php echo route('user.publications.edit',$publication->id) ?>">
                                <p>Редактировать</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<!-- Preview modal -->
<div class="modal fade preview-modal min-modal" id="preview-modal-{{$publication->id}}" tabindex="-1" role="dialog" ,aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="preview-inner">
                <div class="title min-offset">Попередій перегляд посту</div>
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
                        <div class="copy-block" data-success="Скопійовано!">
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