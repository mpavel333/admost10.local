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

                
                <div class="panel-main channel-inner">
                    <div class="channel-info white-block">
                        <div class="photo">
                            <img src="images/ch-photo-1.jpg" alt="photo">
                        </div>
                        <div class="info-summary">
                            <div class="is-top">
                                <div class="name">
                                    <p>Arestovich / Official</p>
                                    <div class="icon">
                                        <img src="images/verified.svg" alt="verified">
                                    </div>
                                </div>
                                <div class="link">
                                    <a class="cl-btn dark-bd-btn w-auto" href="#">
                                        @O_Arestovich_official
                                    </a>
                                </div>
                            </div>
                            <!-- statistic mobile -->
                            <div class="statistic-mobile d-ld-none"></div>
                            <div class="is-bottom">
                                <div class="row g-0">
                                    <div class="col-12 col-md-8">
                                        <div class="text">
                                            <p>������������ Офіційний канал Олексiя Арестовича</p>
                                            <p>������ Засновника і викладача школи мислення @apeiron_school</p>
                                            <p>������‍������ Громадського діяча, політичного та воєнного оглядача.</p>
                                            <p>������Офіційні ресурси: https://lnk.bio/alexey.arestovich</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="types">
                                            <div class="t-block">
                                                <div class="min-tit">Категория</div>
                                                <div class="txt">Публічна персона</div>
                                            </div>
                                            <div class="t-block">
                                                <div class="min-tit">Гео та мова каналу</div>
                                                <div class="txt">Україна, Українська</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- statistic desktop -->
                        <div class="statistic-wrapper d-none d-lg-block">
                            <div class="statistic statistic-move">
                                <div class="s-block">
                                    <div class="number">406.4 К</div>
                                    <p>Підпісників</p>
                                </div>
                                <div class="s-block">
                                    <div class="number">23.5 М</div>
                                    <p>Переглядів</p>
                                </div>
                                <div class="s-block">
                                    <div class="number">10 К</div>
                                    <p>Згадувань</p>
                                </div>
                                <div class="s-block">
                                    <div class="number">23%</div>
                                    <p>ERR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="channel-pages white-block">
                        <div class="links-wrapper">
                            <div class="links">
                                <div class="link">
                                    <a class="active" href="">Покупка реклами</a>
                                </div>
                                <div class="link">
                                    <a href="">Аналітика каналу</a>
                                </div>
                                <div class="link">
                                    <a href="">Відгуки</a>
                                </div>
                            </div>
                        </div>
                        <div class="steps">
                            <form action="" method="post">
                                <div class="s-row">
                                    <div class="step-block">
                                        <div class="s-tit">Крок 1</div>
                                        <div class="tit">Оберіть тариф</div>
                                        <div class="radioboxes">
                                            <div class="radiobox">
                                                <input class="nulled" type="radio" name="tariff" id="tr-1" checked>
                                                <label for="tr-1">
                                                    <p>1/24</p>
                                                    <div class="price">
                                                        <span>3 000</span> грн
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="radiobox">
                                                <input class="nulled" type="radio" name="tariff" id="tr-2">
                                                <label for="tr-2">
                                                    <p>3/48</p>
                                                    <div class="price">
                                                        <span>6 000</span> грн
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="radiobox">
                                                <input class="nulled" type="radio" name="tariff" id="tr-3">
                                                <label for="tr-3">
                                                    <p>4/72</p>
                                                    <div class="price">
                                                        <span>9 000</span> грн
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="info">Вище відображаються тарифи, які пропонує адміністратор цього каналу. Оберіть підходящий та переходьте до наступного кроку</div>
                                    </div>
                                    <div class="step-block for-dates">
                                        <div class="s-tit">Крок 2</div>
                                        <div class="tit">Дата публікації</div>
                                        <div class="dates">
                                            <div class="inputblock date-block">
                                                <p>Вкажіть дату та час розміщення</p>
                                                <div class="inputs">
                                                    <div class="date-input icon-input">
                                                        <label for="date-1">
                                                            <img src="images/date.svg" alt="date">
                                                        </label>
                                                        <input class="form-control nulled" id="date-1" type="date" placeholder="ДД.ММ.РРРР" required>
                                                    </div>
                                                    <div class="time-input icon-input">
                                                        <label for="time-1">
                                                            <img src="images/time.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" id="time-1" type="time" placeholder="00:00" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="inputblock date-block">
                                                <p>Відповісти не пізніше</p>
                                                <div class="inputs">
                                                    <div class="date-input icon-input">
                                                        <label for="date-2">
                                                            <img src="images/date.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" id="date-2" type="date" placeholder="ДД.ММ.РРРР" required>
                                                    </div>
                                                    <div class="time-input icon-input">
                                                        <label for="time-2">
                                                            <img src="images/time.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" id="time-2" type="time" placeholder="00:00" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="info">Вище відображаються тарифи, які пропонує адміністратор цього каналу. Оберіть підходящий та переходьте до наступного кроку</div>
                                    </div>
                                    <div class="step-block message">
                                        <div class="s-tit">Крок 3</div>
                                        <div class="tit">Рекламне повідомлення</div>
                                        <div class="inputblock">
                                            <input type="text" placeholder="Посилання на канал або ресурс" name="link" class="form-control">
                                        </div>
                                        <div class="inputblock message-field">
                                            <textarea class="form-control" name="message" placeholder="Рекламне повідомлення"></textarea>
                                            <div class="file-menu dropdown-link">
                                                <div class="main-icon fill-inherit full-opacity">
                                                    <?php include 'images/file.svg'; ?>
                                                </div>
                                                <div class="file-dropdown dropdown-default top">
                                                    <div class="dropdown-inner">
                                                        <div class="link">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#photo-video-modal">
                                                                <div class="icon fill-inherit">
                                                                    <?php include 'images/img-ic.svg'; ?>
                                                                </div>
                                                                <p>Фото чи відео</p>
                                                            </a>
                                                        </div>
                                                        <div class="link">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#file-modal">
                                                                <div class="icon fill-inherit">
                                                                    <?php include 'images/file-ic.svg'; ?>
                                                                </div>
                                                                <p>Файл</p>
                                                            </a>
                                                        </div>
                                                        <div class="link">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#quiz-modal">
                                                                <div class="icon fill-inherit">
                                                                    <?php include 'images/rate-ic.svg'; ?>
                                                                </div>
                                                                <p>Опитування</p>
                                                            </a>
                                                        </div>
                                                        <div class="link">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#links-modal">
                                                                <div class="icon fill-inherit">
                                                                    <?php include 'images/img-ic.svg'; ?>
                                                                </div>
                                                                <p>Посилання</p>
                                                            </a>
                                                        </div>
                                                        <div class="link">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#text-modal">
                                                                <div class="icon fill-inherit">
                                                                    <?php include 'images/link-ic.svg'; ?>
                                                                </div>
                                                                <p>Прихований текст</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="info">Вище відображаються тарифи, які пропонує адміністратор цього каналу. Оберіть підходящий та переходьте до наступного кроку</div>
                                    </div>
                                </div>
                            </form>
                            <div class="for-btn text-center mt-4">
                                <button type="submit" class="cl-btn big">
                                    <p>Відправити на модерацію</p>
                                    <div class="icon ms-2">
                                        <?php include 'images/arr-top-right.svg'; ?>
                                    </div>
                                </button>
                            </div>
                        </div>
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