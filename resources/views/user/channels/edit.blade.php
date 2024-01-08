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

                <div class="panel-main channel-new white-block">
                    <h1 class="title gap-title d-flex align-items-center">
                        <div class="icon lh-0 me-3">
                            <a href="{{ route('user.channels') }}">
                                <img src="images/arr.svg" alt="icon">
                            </a>
                        </div>
                        <p>Редактировать канал</p>
                    </h1>
                    <div class="channel-fields">
                        <form action="{{ route('user.channels.edit.submit',$channel->id) }}" method="post">
                            @csrf
                            <div class="f-row">
                                <div class="info-column basic-info p-0">
                                    <div class="text-block">
                                        <div class="tit">Посилання на канал</div>
                                        <div class="inputblock">
                                            <input name="link" value="{{$channel->link}}" disabled="" type="text" placeholder="https://t.me/yourchanell" class="form-control" required>
                                            <p class="info"></p>
                                        </div>
                                    </div>
                                    <div class="text-block">
                                        <div class="tit">Тематика каналу</div>
                                        <div class="inputblock">
                                            <select id="category_id" name="category_id" class="form-select">
                                                
                                                @foreach ($categories as $category)
                                                
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                    
                                                @endforeach

                                            </select>
                                            <script type="text/javascript">document.getElementById("category_id").value = '{{$channel->category_id}}';</script>
                                            <p class="info">Можна обрати до 3х категорій</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-column formats">
                                    <div class="tit">Формати розміщення</div>
                                    <div class="fields-block">
                                        <div class="all-formats">
                                            
                                                @foreach ($tariffs as $tariff)
                                                
                                                <div class="inputblock format-block clone-block filled removable" data-currency="грн">
                                                    <div class="check"></div>
                                                    <div class="delete-icon-main" data-id="{{$tariff->id}}"></div>
                                                    <input class="format-input clone-input" name="format[{{$tariff->id}}]" value="{{$tariff->format}}" placeholder="Свій формат" type="text">
                                                    <div class="divider"></div>
                                                    <input class="price-input clone-input" name="price[{{$tariff->id}}]" value="{{$tariff->price}}" placeholder="Вкажіть ціну" type="text" onkeypress='validate(event)'>
                                                </div>
                                                    
                                                @endforeach                                            
                                            

                                        </div>
                                        <div class="del-formats">
                                            
                                        </div>
                                        <div class="for-btn">
                                            <a class="cl-btn w-100 new-clone-btn" href="#" data-wrapper=".all-formats" data-template=".format-template">
                                                <div class="icon">
                                                    
                                                    <?php include 'images/plus.svg'; 
                                                    //<img src="images/plus.svg" alt="icon">?>
                                                    
                                                </div>
                                                <p class="text-start">Додати свій формат</p>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="info">Тут одразу пояснюємо, що таке формат розміщення, для таких, як я)))</p>
                                </div>
                                <div class="info-column description">
                                    <div class="tit">Джерело підписників</div>
                                    <div class="inputblock">
                                        <textarea class="form-control" name="description" placeholder="Опис">{{$channel->description}}</textarea>
                                    </div>
                                    <p class="info" id="description">Детально вкажіть методи просування каналу і тд</p>
                                </div>
                            </div>
                            <div class="for-btn text-center add-btn-wrapper">
                                <button type="submit" class="cl-btn big">
                                    <p>Відправити на модерацію</p>
                                    <div class="icon ms-2">
                                        
                                        <?php include 'images/arr-top-right.svg'; 
                                        //<img src="images/arr-top-right.svg" alt="icon">
                                        ?>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel-banner white-block min-banner">

                </div>                  
                

            </div>
        </div>
    </div>


    <!-- Format template -->
    <template class="format-template">
        <div class="inputblock clone-block format-block removable" data-currency="грн">
            <div class="check"></div>
            <div class="delete-icon-main"></div>
            <input class="clone-input format-input" name="format_new[]" placeholder="Свій формат" type="text">
            <div class="divider"></div>
            <input class="clone-input price-input" name="price_new[]" placeholder="Вкажіть ціну" type="text" onkeypress='validate(event)'>
        </div>
    </template>


    <!-- all plugins -->
    @include('inc.scripts')
    <?php //include 'scripts.php'; ?>

</body>

</html>