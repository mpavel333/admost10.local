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

                <div class="panel-main channel-new white-block">
                    <h1 class="title gap-title d-flex align-items-center">
                        <div class="icon lh-0 me-3">
                            <img src="images/arr.svg" alt="icon">
                        </div>
                        <p>Додати канал</p>
                    </h1>
                    <div class="channel-fields">
                        <form action="{{ route('user.channels.add.submit') }}" method="post">
                            @csrf
                            <div class="f-row">
                                <div class="info-column basic-info p-0">
                                    <div class="text-block">
                                        <div class="tit">Посилання на канал</div>
                                        <div class="inputblock">
                                            <input name="link" type="text" placeholder="https://t.me/yourchanell" class="form-control" required>
                                            <p class="info">Вкажіть посилання на Ваш канал, бажане публічне посилання на канал</p>
                                        </div>
                                    </div>
                                    <div class="text-block">
                                        <div class="tit">Тематика каналу</div>
                                        <div class="inputblock">
                                            <select name="category" class="form-select">
                                                <option value="">Категорія 1</option>
                                                <option value="">Категорія 2</option>
                                                <option value="">Категорія 3</option>
                                            </select>
                                            <p class="info">Можна обрати до 3х категорій</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-column formats">
                                    <div class="tit">Формати розміщення</div>
                                    <div class="fields-block">
                                        <div class="all-formats">
                                            <div class="inputblock format-block clone-block filled removable" data-currency="грн">
                                                <div class="check"></div>
                                                <div class="delete-icon-main"></div>
                                                <input class="format-input clone-input" name="format" value="1/24" placeholder="Свій формат" type="text">
                                                <div class="divider"></div>
                                                <input class="price-input clone-input" name="price" value="3000 грн" placeholder="Вкажіть ціну" type="text">
                                            </div>
                                            <div class="inputblock format-block clone-block removable" data-currency="грн">
                                                <div class="check"></div>
                                                <div class="delete-icon-main"></div>
                                                <input class="format-input clone-input" name="format" placeholder="Свій формат" type="text">
                                                <div class="divider"></div>
                                                <input class="price-input clone-input" name="price" placeholder="Вкажіть ціну" type="text">
                                            </div>
                                            <div class="inputblock format-block clone-block removable" data-currency="грн">
                                                <div class="check"></div>
                                                <div class="delete-icon-main"></div>
                                                <input class="format-input clone-input" name="format" placeholder="Свій формат" type="text">
                                                <div class="divider"></div>
                                                <input class="price-input clone-input" name="price" placeholder="Вкажіть ціну" type="text">
                                            </div>
                                        </div>
                                        <div class="for-btn">
                                            <a class="cl-btn w-100 new-clone-btn" href="#" data-wrapper=".all-formats" data-template=".format-template">
                                                <div class="icon">
                                                    <img src="images/plus.svg" alt="icon">
                                                    <?php //include 'images/plus.svg'; ?>
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
                                        <textarea class="form-control" name="description" placeholder="Опис"></textarea>
                                    </div>
                                    <p class="info" id="description">Детально вкажіть методи просування каналу і тд</p>
                                </div>
                            </div>
                            <div class="for-btn text-center add-btn-wrapper">
                                <button type="submit" class="cl-btn big">
                                    <p>Відправити на модерацію</p>
                                    <div class="icon ms-2">
                                        <img src="images/arr-top-right.svg" alt="icon">
                                        <?php //include 'images/arr-top-right.svg'; ?>
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

    <!-- all plugins -->
    @include('user.inc.scripts')
    <?php //include 'scripts.php'; ?>

</body>

</html>