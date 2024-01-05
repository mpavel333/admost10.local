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



                
                <div class="panel-main orders white-block">
                
                @include('user.inc.alerts')
                
                    <h1 class="title gap-title">
                        <p>Ваши исходящие заявки на рекламу </p>
                    </h1>
                    
                    <div class="orders-inner">
                        <div class="collapses">
                        
@foreach ($orders as $order)


        <div class="collapse-block">
            <button class="btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order-{{$order->id}}">
                <div class="c-block cbl-1">
                    <div class="channel-order-info">
                        <div class="pic">
                            <img src="@if($order->channel_image)images\channels\{{$order->channel_image}}@else images\channels\no-image.png @endif" alt="pic">
                            <div class="notification-count gray">3</div>
                        </div>
                        <div class="main-info">
                            <div class="name-row">
                                <div class="name">
                                    {{ $order->channel_name }}
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
                        <div class="number">{{$order->published}}</div>
                    </div>
                    <div class="number-block">
                        <p>Час публікації</p>
                        <div class="number">10:00 - 19:00</div>
                    </div>
                </div>
                <div class="c-block cbl-4">
                    <div class="other-info">
                        <p>{{$order->created_at}}</p>
                        <p>№{{$order->id}}</p>
                    </div>
                </div>
            </button>
            <div class="collapse" id="order-{{$order->id}}">
                <div class="card">
                    <div class="collapse-content">
                        <div class="c-block cbl-1">
                            <div class="for-text">
                                <div class="tit">Рекламний текст</div>
                                <div class="text">
                                    <p>{{ $order->message }}</p>
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
                                <input value="{{ $order->link }}" type="text" readonly>
                                <div class="icon">
                                    <img src="images/copy-icon.svg" alt="copy">
                                </div>
                            </div>
                        </div>
                        <div class="c-block cbl-4">
                            <div class="preview-pic-btn" data-bs-toggle="modal" data-bs-target="#preview-modal-{{$order->id}}">
                                <img src="@if($order->images[0]->filename){{$order->images[0]->path}}/{{$order->images[0]->filename}}@else images\channels\no-image.png @endif" alt="preview">
                                <div class="icon preview-icon fill-inherit">
                                    <?php include 'images/eye.svg'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse-buttons">
                    {{--
                        <div class="for-btn">
                            <a class="cl-btn" href="#">
                                Прийняти заявку
                            </a>
                        </div>
                    --}}
                        @if($order->status==1)
                        <div class="for-btn">
                            <a class="cl-btn btn-success">Заявка принята</a>
                        </div>
                        @endif                    
                    
                        <div class="for-btn">
                            <a class="cl-btn cl-btn blue-l-btn open-chat" data-bs-toggle="modal" data-bs-target="#chat-modal-{{$order->id}}" order_id="{{$order->id}}" user_id="{{$order->user_id}}" hash="<?php echo hash('sha256', $order->id.$order->user_id.env('CHAT_HASH_SOLT')) ?>" href="#">
                                <p>Відкрити чат</p>
                                <div class="notification-count blue ms-2">{{$order->chat_messages_count}}</div>
                            </a>
                        </div>
                    {{--
                        <div class="for-btn">
                            <a class="cl-btn deny-btn" data-bs-toggle="modal" data-bs-target="#deny-modal" href="#">
                                Відхилити заявку
                            </a>
                        </div>
                    --}}
                    </div>
                </div>
            </div>
        </div>


<!-- Preview modal -->
<div class="modal fade preview-modal min-modal" id="preview-modal-{{$order->id}}" tabindex="-1" role="dialog" ,aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="preview-inner">
                <div class="title min-offset">Попередій перегляд посту</div>
                <div class="modal-blocks min-offset">
                    <div class="modal-block">
                        <div class="pic">
                            <img src="@if($order->images[0]->filename){{$order->images[0]->path}}/{{$order->images[0]->filename}}@else images\channels\no-image.png @endif" alt="preview">
                        </div>
                    </div>
                    <div class="modal-block">
                        <div class="text content-scroll">
                            <p>{{ $order->message }}</p>
                        </div>
                    </div>
                    <div class="modal-block">
                        <div class="copy-block" data-success="Скопійовано!">
                            <input value="{{ $order->link }}" type="text" readonly>
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



<!-- Chat modal -->
<div class="modal fade chat-modal" id="chat-modal-{{$order->id}}" tabindex="-1" role="dialog" ,aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="for-chat">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="chat-inner">
                    <div class="chat-head">
                        <div class="title">Онлайн чат с владельцем канала</div>
                    </div>
                    <div class="chat-order-info">
                        <div class="c-block cbl-1">
                            <div class="channel-order-info">
                                <div class="pic">
                                    <img src="@if($order->channel_image)images\channels\{{$order->channel_image}}@else images\channels\no-image.png @endif" alt="pic">
                                </div>
                                <div class="main-info">
                                    <div class="name-row">
                                        <div class="name">
                                            {{ $order->channel_name }}
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
                                <div class="number">26.04.2023</div>
                            </div>
                            <div class="number-block">
                                <p>Час публікації</p>
                                <div class="number">10:00 - 19:00</div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-messages">
                        <div class="messages-content content-scroll">
                            <div class="date-block">
                                <div class="date">24 лютого</div>
                            </div>
                            <div id="messages-{{$order->id}}">
                            
                            </div>

                        </div>
                    </div>
                    <div class="chat-controls">
                        <form class="form_send" action="{{ route('chat.send_message') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" value="{{$order->id}}"/>
                            <input type="hidden" name="user_id" value="{{$order->user_id}}"/>
                            <textarea placeholder="Повідомленя" name="message" class="form-control"></textarea>
                            <button type="submit" class="cl-btn no-stroke">
                                <div class="icon fill-inherit">
                                    <?php include 'images/paperplane.svg'; ?>
                                </div>
                            </button>
                        </form>
                        <div class="icon preview-icon fill-inherit">
                            <?php include 'images/eye.svg'; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="preview-modal-block">
                <button type="button" class="btn-close"></button>
                <div class="preview-inner">
                    <div class="preview-title">Попередій перегляд посту</div>
                    <div class="modal-blocks min-offset">
                        <div class="modal-block">
                            <div class="pic">
                                <img src="images/preview.jpg" alt="preview">
                            </div>
                        </div>
                        <div class="modal-block">
                            <div class="text content-scroll">
                                <p>Тут буде рекламний текст про офігезний продукт або послугу, яку хочуть прорекламувати у телеграм-каналі. Тут буде рекламний текст про офігезний продукт або послугу, яку хочуть прорекламувати у телеграм-каналіТут буде рекламний текст про офігезний продукт або послугу, яку хочуть прорекламувати у телеграм-каналі</p>
                            </div>
                        </div>
                        <div class="modal-block">
                            <div class="copy-block" data-success="Скопійовано!">
                                <input value="https://admost.com.ua/link" type="text" readonly>
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
</div>



<!-- Chat modal -->



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
    
    
    @include('user.inc.modals')
    
    <!-- all plugins -->
    @include('user.inc.scripts')
    <?php //include 'scripts.php'; ?>

</body>

</html>