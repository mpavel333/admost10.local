<!DOCTYPE html>

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


                <div class="panel-main post-inner">
                    <div class="channel-pages white-block">
                        <div class="links-wrapper">
                            <div class="links channel">
                                
                                @foreach ($channels as $channel)
                                
                                <div class="link">
                                    <a channel_id="{{$channel->id}}">
                                        <div class="pic">
                                            <img src="@if($channel->image)images\channels\{{$channel->image}}@else images\channels\no-image.png @endif" alt="pic">
                                        </div>
                                        <p>{{$channel->link}}</p>
                                    </a>
                                </div>
                                
                                @endforeach
                                
                                @if(count($channels) == 0) {{ __('text.text_') }}Добавьте минимум 1 канал @endif

                            </div>
                        </div>
                        <div class="steps">
                        
                        @if(count($channels) != 0)
                        
                            <form id="form_publication" action="{{ route('user.publications.submit') }}" method="post">
                            @csrf
                                <div class="s-row">
                                    <div class="step-block message">
                                        <div class="tit">{{ __('text.text_51') }}</div>
                                        <div class="step-block settings">
                                        <div class="tit">{{ __('text.text_181') }}</div>
                                        <div class="fields-block">
                                            
                                            <select name="type" required>
                                                <option value=""></option>
                                                <option value="1">{{ __('text.text_175') }}</option>
                                                <option value="2">{{ __('text.text_176') }}</option>
                                                <option value="3">{{ __('text.text_177') }}</option>
                                                <option value="4">{{ __('text.text_178') }}</option>
                                                <option value="5">{{ __('text.text_179') }}</option>
                                                <option value="6">{{ __('text.text_180') }}</option>
                                            </select>
                                            
                                        </div>
                                    </div>
                                        <!-- <div class="inputblock">
                                            <input type="text" placeholder="{{ __('text.text_161') }}" name="link" class="form-control" required="">
                                        </div> -->
                                        <div class="inputblock message-field">
                                            <textarea class="form-control" name="message" placeholder="{{ __('text.text_162') }}" required=""></textarea>
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
                                                                <p>{{ __('text.text_163') }}</p>
                                                            </a>
                                                        </div>
                                                        <div class="link">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#file-modal">
                                                                <div class="icon fill-inherit">
                                                                    <?php include 'images/file-ic.svg'; ?>
                                                                </div>
                                                                <p>{{ __('text.text_164') }}</p>
                                                            </a>
                                                        </div>
                                                        <div class="link">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#quiz-modal">
                                                                <div class="icon fill-inherit">
                                                                    <?php include 'images/rate-ic.svg'; ?>
                                                                </div>
                                                                <p>{{ __('text.text_165') }}</p>
                                                            </a>
                                                        </div>
                                                        <div class="link">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#links-modal">
                                                                <div class="icon fill-inherit">
                                                                    <?php include 'images/link-ic.svg'; ?>
                                                                </div>
                                                                <p>{{ __('text.text_166') }}</p>
                                                            </a>
                                                        </div>
                                                        <div class="link">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#text-modal">
                                                                <div class="icon fill-inherit">
                                                                    <?php include 'images/txt-ic.svg'; ?>
                                                                </div>
                                                                <p>{{ __('text.text_167') }}</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="file-content">
                                            <div class="file-links file-row">

                                            </div>
                                            <div class="file-media file-row">
                                                <a class="cl-btn blue-l-btn" href="#" data-bs-toggle="modal" data-bs-target="#photo-video-modal">
                                                    <div class="icon">
                                                        <?php include 'images/plus.svg'; ?>
                                                    </div>
                                                </a>

                                            </div>
                                            <div class="file-quiz file-row">
                                                
                                            </div>
                                            <div class="file-text file-row">
                                                
                                            </div>
                                            <div class="file-blocks file-row">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="step-block settings">
                                        <div class="tit">Попередній перегляд публікації</div>
                                        <div class="posting-block prev-post">
                                            <div class="posting-head"></div>
                                            <div class="posting-body">
                                                <div class="media-block">
                                                    <div class="images-block">
                                                        <div class="attachment_file">
                                                            <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                        </div>
                                                        <div class="attachment_file">
                                                            <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                        </div>
                                                        <div class="attachment_file">
                                                            <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-block">
                                                    <strong>Yoast WordPress SEO Premium 22.8 NULLED + Free 22.8</strong><br>
                                                    <em><code>Last updated:30 May 2024</code></em><br>
                                                    Yoast SEO Premium Nulled (formerly known as WordPress SEO by Yoast) is the most complete WordPress SEO plugin that exists today for WordPress users. It incorporates everything from a snippet editor and real time page analysis functionality that helps you optimize your pages content, images titles, meta descriptions and more to XML sitemaps, and loads of optimization options in between.
                                                </div>
                                            </div>
                                            <div class="posting-footer">
                                                <div class="links-block">
                                                    <div class="links-line">
                                                        <a href="">Кнопка 1 на всю ширину</a>
                                                    </div>
                                                    <div class="links-line">
                                                        <a href="">Кнопка 1</a><a href="">Кнопка 2</a>
                                                    </div>
                                                    <div class="links-line">
                                                        <a href="">Кнопка 1</a><a href="">Кнопка 2</a><a href="">Кнопка 3</a>
                                                    </div>
                                                    <div class="links-line">
                                                        <a href="">1</a><a href="">2</a><a href="">3</a><a href="">4</a>
                                                        <a href="">5</a><a href="">6</a><a href="">7</a><a href="">8</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="step-block for-dates">
                                        
                                        <div class="tit">{{ __('text.text_168') }}</div>
                                        <div class="dates">
                                            <div class="inputblock date-block">
                                                <p>{{ __('text.text_169') }}</p>
                                                <div class="inputs">
                                                    <div class="date-input icon-input">
                                                        <label for="date-1">
                                                            <img src="images/date.svg" alt="date">
                                                        </label>
                                                        <input class="form-control nulled" id="date-1" name="date-1" type="date" placeholder="{{ __('text.text_170') }}" required>
                                                    </div>
                                                    <div class="time-input icon-input">
                                                        <label for="time-1">
                                                            <img src="images/time.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" id="time-1" name="time-1" type="time" placeholder="00:00" required>
                                                    </div>
                                                </div>
                                                <p>
                                                    оставьте поля пустыми, и дата публикации будет браться автоматически с настроеного вами графика публикаций в настройках канала внизу. 
                                                    <b>Для тз мы внизу сделаем настройку канала где будет сделан функционал шаблона графика публикаций для того чтоб пользователь 
                                                        один раз настроил график и все посты выходили согласно настроеному графику. Например он выбрал что в понедельник у него посты выходят
                                                     в 10:15 и 17:37 и так по каждому дню, а мы уже берем отсюда инфу и при создании нового поста подставляем автоматически</b> 
                                                </p>
                                                
                                            </div>
                                            <div class="inputblock date-block">
                                                <p>{{ __('text.text_171') }} <input type="checkbox"  name="" id=""></p>
                                                <p>Нужно поставить чекбокс, при включенном чекбоксе ввыдавать опции выбора повтора публикации:</p>
                                                    <p> Каждые 
                                                        <input type="text" value="1" style="width: 30px">
                                                        <select name="" id="">
                                                            <option value="">минут</option>
                                                            <option value="">часов</option>
                                                            <option value="">дней</option>
                                                        </select>
                                                        <input type="text" value="1" style="width: 30px">
                                                        раз (0 - бесконечно)
                                                    </p>
                                            </div>
                                            <div class="inputblock date-block">
                                                <p>{{ __('text.text_172') }}</p>
                                                <div class="inputs">
                                                    <div class="date-input icon-input">
                                                        <label for="date-3">
                                                            <img src="images/date.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" id="date-3" name="date-3" type="date" placeholder="{{ __('text.text_170') }}" >
                                                    </div>
                                                    <div class="time-input icon-input">
                                                        <label for="time-3">
                                                            <img src="images/time.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" id="time-3" name="time-3" type="time" placeholder="00:00" >
                                                    </div>
                                                </div>
                                                <p>информация для юзера: бот автоматически может удалять посты не старше 48 часов. Если дата вашего автоматического удаления 
                                                    превышает 48 часов, наш бот автопостинга пришлет вам напоминание для ручного удаления</p>
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="tit">{{ __('text.text_111') }}</div>
                                        <div class="fields-block">
                                            <div class="settings-line">
                                                <label for="notifications-check">{{ __('text.text_173') }}</label>
                                                <input id="notifications-check" name="notifications" type="checkbox" checked>
                                            </div>
                                            <div class="settings-line">
                                                <label for="place-check">{{ __('text.text_174') }}</label>
                                                <input id="place-check" name="place" type="checkbox">
                                            </div>
                                            <div class="table-time">
                                                    <div class="line-day">
                                                        <div class="day-c">Пн.</div>
                                                        <div class="inpb">
                                                            <input type="text" value="10:00" />
                                                            <input type="text" value="13:00" />
                                                            <input type="text" value="16:00" />
                                                        </div>
                                                        <div class="actions">
                                                            <button>+</button>
                                                        </div>
                                                    </div>
                                                    <div class="line-day">
                                                        <div class="day-c">Вт.</div>
                                                        <div class="inpb">
                                                            <input type="text" value="10:00" />
                                                            <input type="text" value="13:00" />
                                                            <input type="text" value="16:00" />
                                                        </div>
                                                        <div class="actions">
                                                            <button>+</button>
                                                        </div>
                                                    </div>
                                                    <div class="line-day">
                                                        <div class="day-c">Ср.</div>
                                                        <div class="inpb">
                                                            <input type="text" value="10:00" />
                                                            <input type="text" value="13:00" />
                                                            <input type="text" value="16:00" />
                                                        </div>
                                                        <div class="actions">
                                                            <button>+</button>
                                                        </div>
                                                    </div>
                                                    <div class="line-day">
                                                        <div class="day-c">Чт.</div>
                                                        <div class="inpb">
                                                            <input type="text" value="10:00" />
                                                            <input type="text" value="13:00" />
                                                            <input type="text" value="16:00" />
                                                        </div>
                                                        <div class="actions">
                                                            <button>+</button>
                                                        </div>
                                                    </div>
                                                    <div class="line-day">
                                                        <div class="day-c">Пт.</div>
                                                        <div class="inpb">
                                                            <input type="text" value="10:00" />
                                                            <input type="text" value="13:00" />
                                                            <input type="text" value="16:00" />
                                                        </div>
                                                        <div class="actions">
                                                            <button>+</button>
                                                        </div>
                                                    </div>
                                                    <div class="line-day">
                                                        <div class="day-c">Сб.</div>
                                                        <div class="inpb">
                                                            <input type="text" value="10:00" />
                                                            <input type="text" value="13:00" />
                                                            <input type="text" value="16:00" />
                                                        </div>
                                                        <div class="actions">
                                                            <button>+</button>
                                                        </div>
                                                    </div>
                                                    <div class="line-day">
                                                        <div class="day-c">Нд.</div>
                                                        <div class="inpb">
                                                            <input type="text" value="10:00" />
                                                            <input type="text" value="13:00" />
                                                            <input type="text" value="16:00" />
                                                        </div>
                                                        <div class="actions">
                                                            <button>+</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="auto-sign">
                                                    <div class="sign-head"><input type="checkbox"  name="av" id=""> <label for="av">Автоподпись к посту</label></div>
                                                    <div class="sign-text">
                                                        <textarea name="" id="" placeholder="Укажите текст для подписи в постах, он бьудет применен автоматически для всех новых публикаций"></textarea>
                                                    </div>
                                                </div>
                                        </div>
                                        <br><br>
                                        <div class="for-btn text-center mt-4">
                                            <button type="submit" class="cl-btn big no-stroke">
                                                <p>{{ __('text.text_182') }}</p>
                                                <div class="icon ms-2 fill-inherit">
                                                    <?php include 'images/calendar.svg'; ?>
                                                </div>
                                            </button>
                                            <button>попередній перегляд в бота</button>
                                            <button>Опублікувати прямо зараз</button>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                                
                                <?php /*
                                        <input type="hidden" name="channel_id" value="{{ $channel->id }}"/>
                                        
                                        <div id="hide_text"></div>
                                        
                                    */
                                ?>
                                <div id="files"></div>                                 
                                
                                <div id="links"></div>                                 
                                
                                <div id="question"></div>
                                
                                <input type="hidden" id="hide_text" name="hide_text" value=""/> 
                                
                            
                            <div class="for-btn text-center mt-4">
                                <button type="submit" class="cl-btn big no-stroke">
                                    <p>{{ __('text.text_182') }}</p>
                                    <div class="icon ms-2 fill-inherit">
                                        <?php include 'images/calendar.svg'; ?>
                                    </div>
                                </button>
                            </div>
                            
                            </form>
                            
                            @endif
                            
                        </div>
                        <div class="block">
                            <p>Сюда мы выводим все запланированые посты вформате табов кликая по кнопкам - отображается тот или иной вид</p><br><br>
                            <p><button>Список</button><button>По датам</button><button>Календарь</button></p>
                            <br><br>
                        </div>
                        <div class="delay-posts">
                            <ul>
                                <li>
                                    <div class="posting-block">
                                        <div class="posting-head">
                                           <div class="time">
                                                <b>06 марта 2024</b> <span>10:05</span>
                                           </div>
                                           <div class="actions">
                                            <button>Ред.</button>
                                            <button>Опубл.</button>
                                            <button>Удалить</button>
                                            <button>Удалить из TG</button>
                                           </div>     
                                        </div>
                                        <div class="posting-body">
                                            <div class="media-block">
                                                <div class="images-block">
                                                    <div class="attachment_file">
                                                        <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                    </div>
                                                    <div class="attachment_file">
                                                        <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                    </div>
                                                    <div class="attachment_file">
                                                        <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-block">
                                                <strong>Yoast WordPress SEO Premium 22.8 NULLED + Free 22.8</strong><br>
                                                <em><code>Last updated:30 May 2024</code></em><br>
                                                Yoast SEO Premium Nulled (formerly known as WordPress SEO by Yoast) is the most complete WordPress SEO plugin that exists today for WordPress users. It incorporates everything from a snippet editor and real time page analysis functionality that helps you optimize your pages content, images titles, meta descriptions and more to XML sitemaps, and loads of optimization options in between.
                                            </div>
                                        </div>
                                        <div class="posting-footer">
                                            <div class="links-block">
                                                <div class="links-line">
                                                    <a href="">Кнопка 1 на всю ширину</a>
                                                </div>
                                                <div class="links-line">
                                                    <a href="">Кнопка 1</a><a href="">Кнопка 2</a>
                                                </div>
                                                <div class="links-line">
                                                    <a href="">Кнопка 1</a><a href="">Кнопка 2</a><a href="">Кнопка 3</a>
                                                </div>
                                                <div class="links-line">
                                                    <a href="">1</a><a href="">2</a><a href="">3</a><a href="">4</a>
                                                    <a href="">5</a><a href="">6</a><a href="">7</a><a href="">8</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="posting-block">
                                        <div class="posting-head">
                                           <div class="time">
                                                <b>06 марта 2024</b> <span>10:05</span>
                                           </div>
                                           <div class="actions">
                                            <button>Ред.</button>
                                            <button>Опубл.</button>
                                            <button>Удалить</button>
                                            <button>Удалить из TG</button>
                                           </div>     
                                        </div>
                                        <div class="posting-body">
                                            <div class="media-block">
                                                <div class="images-block">
                                                    <div class="attachment_file">
                                                        <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                    </div>
                                                    <div class="attachment_file">
                                                        <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                    </div>
                                                    <div class="attachment_file">
                                                        <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-block">
                                                <strong>Yoast WordPress SEO Premium 22.8 NULLED + Free 22.8</strong><br>
                                                <em><code>Last updated:30 May 2024</code></em><br>
                                                Yoast SEO Premium Nulled (formerly known as WordPress SEO by Yoast) is the most complete WordPress SEO plugin that exists today for WordPress users. It incorporates everything from a snippet editor and real time page analysis functionality that helps you optimize your pages content, images titles, meta descriptions and more to XML sitemaps, and loads of optimization options in between.
                                            </div>
                                        </div>
                                        <div class="posting-footer">
                                            <div class="links-block">
                                                <div class="links-line">
                                                    <a href="">Кнопка 1 на всю ширину</a>
                                                </div>
                                                <div class="links-line">
                                                    <a href="">Кнопка 1</a><a href="">Кнопка 2</a>
                                                </div>
                                                <div class="links-line">
                                                    <a href="">Кнопка 1</a><a href="">Кнопка 2</a><a href="">Кнопка 3</a>
                                                </div>
                                                <div class="links-line">
                                                    <a href="">1</a><a href="">2</a><a href="">3</a><a href="">4</a>
                                                    <a href="">5</a><a href="">6</a><a href="">7</a><a href="">8</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="posting-block">
                                        <div class="posting-head">
                                           <div class="time">
                                                <b>06 марта 2024</b> <span>10:05</span>
                                           </div>
                                           <div class="actions">
                                            <button>Ред.</button>
                                            <button>Опубл.</button>
                                            <button>Удалить</button>
                                            <button>Удалить из TG</button>
                                           </div>     
                                        </div>
                                        <div class="posting-body">
                                            <div class="media-block">
                                                <div class="images-block">
                                                    <div class="attachment_file">
                                                        <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                    </div>
                                                    <div class="attachment_file">
                                                        <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                    </div>
                                                    <div class="attachment_file">
                                                        <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-block">
                                                <strong>Yoast WordPress SEO Premium 22.8 NULLED + Free 22.8</strong><br>
                                                <em><code>Last updated:30 May 2024</code></em><br>
                                                Yoast SEO Premium Nulled (formerly known as WordPress SEO by Yoast) is the most complete WordPress SEO plugin that exists today for WordPress users. It incorporates everything from a snippet editor and real time page analysis functionality that helps you optimize your pages content, images titles, meta descriptions and more to XML sitemaps, and loads of optimization options in between.
                                            </div>
                                        </div>
                                        <div class="posting-footer">
                                            <div class="links-block">
                                                <div class="links-line">
                                                    <a href="">Кнопка 1 на всю ширину</a>
                                                </div>
                                                <div class="links-line">
                                                    <a href="">Кнопка 1</a><a href="">Кнопка 2</a>
                                                </div>
                                                <div class="links-line">
                                                    <a href="">Кнопка 1</a><a href="">Кнопка 2</a><a href="">Кнопка 3</a>
                                                </div>
                                                <div class="links-line">
                                                    <a href="">1</a><a href="">2</a><a href="">3</a><a href="">4</a>
                                                    <a href="">5</a><a href="">6</a><a href="">7</a><a href="">8</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="posting-block">
                                        <div class="posting-head">
                                           <div class="time">
                                                <b>06 марта 2024</b> <span>10:05</span>
                                           </div>
                                           <div class="actions">
                                            <button>Ред.</button>
                                            <button>Опубл.</button>
                                            <button>Удалить</button>
                                            <button>Удалить из TG</button>
                                           </div>     
                                        </div>
                                        <div class="posting-body">
                                            <div class="media-block">
                                                <div class="images-block">
                                                    <div class="attachment_file">
                                                        <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                    </div>
                                                    <div class="attachment_file">
                                                        <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                    </div>
                                                    <div class="attachment_file">
                                                        <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-block">
                                                <strong>Yoast WordPress SEO Premium 22.8 NULLED + Free 22.8</strong><br>
                                                <em><code>Last updated:30 May 2024</code></em><br>
                                                Yoast SEO Premium Nulled (formerly known as WordPress SEO by Yoast) is the most complete WordPress SEO plugin that exists today for WordPress users. It incorporates everything from a snippet editor and real time page analysis functionality that helps you optimize your pages content, images titles, meta descriptions and more to XML sitemaps, and loads of optimization options in between.
                                            </div>
                                        </div>
                                        <div class="posting-footer">
                                            <div class="links-block">
                                                <div class="links-line">
                                                    <a href="">Кнопка 1 на всю ширину</a>
                                                </div>
                                                <div class="links-line">
                                                    <a href="">Кнопка 1</a><a href="">Кнопка 2</a>
                                                </div>
                                                <div class="links-line">
                                                    <a href="">Кнопка 1</a><a href="">Кнопка 2</a><a href="">Кнопка 3</a>
                                                </div>
                                                <div class="links-line">
                                                    <a href="">1</a><a href="">2</a><a href="">3</a><a href="">4</a>
                                                    <a href="">5</a><a href="">6</a><a href="">7</a><a href="">8</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="posting-block">
                                        <div class="posting-head">
                                           <div class="time">
                                                <b>06 марта 2024</b> <span>10:05</span>
                                           </div>
                                           <div class="actions">
                                            <button>Ред.</button>
                                            <button>Опубл.</button>
                                            <button>Удалить</button>
                                            <button>Удалить из TG</button>
                                           </div>     
                                        </div>
                                        <div class="posting-body">
                                            <div class="media-block">
                                                <div class="images-block">
                                                    <div class="attachment_file">
                                                        <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                    </div>
                                                    <div class="attachment_file">
                                                        <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                    </div>
                                                    <div class="attachment_file">
                                                        <img src="https://telega-images.storage.yandexcloud.net/uploads/user/690/2330516/small_photo_2024-07-01_17-14-50.jpg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-block">
                                                <strong>Yoast WordPress SEO Premium 22.8 NULLED + Free 22.8</strong><br>
                                                <em><code>Last updated:30 May 2024</code></em><br>
                                                Yoast SEO Premium Nulled (formerly known as WordPress SEO by Yoast) is the most complete WordPress SEO plugin that exists today for WordPress users. It incorporates everything from a snippet editor and real time page analysis functionality that helps you optimize your pages content, images titles, meta descriptions and more to XML sitemaps, and loads of optimization options in between.
                                            </div>
                                        </div>
                                        <div class="posting-footer">
                                            <div class="links-block">
                                                <div class="links-line">
                                                    <a href="">Кнопка 1 на всю ширину</a>
                                                </div>
                                                <div class="links-line">
                                                    <a href="">Кнопка 1</a><a href="">Кнопка 2</a>
                                                </div>
                                                <div class="links-line">
                                                    <a href="">Кнопка 1</a><a href="">Кнопка 2</a><a href="">Кнопка 3</a>
                                                </div>
                                                <div class="links-line">
                                                    <a href="">1</a><a href="">2</a><a href="">3</a><a href="">4</a>
                                                    <a href="">5</a><a href="">6</a><a href="">7</a><a href="">8</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
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
    <script>
        let date = new Date();
        document.getElementById('date-1').valueAsDate = date;
        document.getElementById('time-1').value = date.getHours() + ":" + date.getMinutes();

        // let nextDay = new Date(date);
        // nextDay.setDate(date.getDate() + 1);
        // document.getElementById('date-3').valueAsDate = nextDay;
        // document.getElementById('time-3').value = date.getHours() + ":" + date.getMinutes();
    </script>
</body>

</html>