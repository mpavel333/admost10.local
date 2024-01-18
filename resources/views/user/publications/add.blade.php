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
                            <div class="links">
                                
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
                                
                                @if(count($channels) == 0) Добавьте минимум 1 канал @endif

                            </div>
                        </div>
                        <div class="steps">
                        
                        @if(count($channels) != 0)
                        
                            <form id="form_publication" action="{{ route('user.publications.submit') }}" method="post">
                            @csrf
                                <div class="s-row">
                                    <div class="step-block message">
                                        <div class="tit">Пост</div>
                                        <div class="inputblock">
                                            <input type="text" placeholder="Посилання на канал або ресурс" name="link" class="form-control" required="">
                                        </div>
                                        <div class="inputblock message-field">
                                            <textarea class="form-control" name="message" placeholder="Текст повідомлення" required=""></textarea>
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
                                                                    <?php include 'images/link-ic.svg'; ?>
                                                                </div>
                                                                <p>Посилання</p>
                                                            </a>
                                                        </div>
                                                        <div class="link">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#text-modal">
                                                                <div class="icon fill-inherit">
                                                                    <?php include 'images/txt-ic.svg'; ?>
                                                                </div>
                                                                <p>Прихований текст</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="file-content">
                                            <div class="file-links file-row">
                                                {{--
                                                <div class="link-line field-line">
                                                    <div class="f-block">
                                                        <div class="icon">
                                                            <?php include 'images/link-ic.svg'; ?>
                                                        </div>
                                                        <p>Кнопка</p>
                                                    </div>
                                                    <div class="field-controls">
                                                        <div class="icon edit-icon"></div>
                                                        <div class="icon delete-icon-main"></div>
                                                    </div>
                                                </div>
                                                <div class="link-line field-line">
                                                    <div class="f-block">
                                                        <div class="icon">
                                                            <?php include 'images/link-ic.svg'; ?>
                                                        </div>
                                                        <p>Кнопка</p>
                                                    </div>
                                                    <div class="field-controls">
                                                        <div class="icon edit-icon"></div>
                                                        <div class="icon delete-icon-main"></div>
                                                    </div>
                                                </div>
                                                --}}
                                            </div>
                                            <div class="file-media file-row">
                                                <a class="cl-btn blue-l-btn" href="#" data-bs-toggle="modal" data-bs-target="#photo-video-modal">
                                                    <div class="icon">
                                                        <?php include 'images/plus.svg'; ?>
                                                    </div>
                                                </a>
                                                
                                                {{--
                                                <div class="media-block">
                                                    <div class="m-icon pic"></div>
                                                    <a class="icon delete-icon-main"></a>
                                                    <img src="images/md-1.jpg" alt="pic">
                                                </div>
                                                <div class="media-block">
                                                    <div class="m-icon vid"></div>
                                                    <div class="icon delete-icon-main"></div>
                                                    <img src="images/md-1.jpg" alt="pic">
                                                </div>
                                                <div class="media-block">
                                                    <div class="m-icon pic"></div>
                                                    <div class="icon delete-icon-main"></div>
                                                    <img src="images/md-1.jpg" alt="pic">
                                                </div>
                                                <div class="media-block">
                                                    <div class="m-icon vid"></div>
                                                    <div class="icon delete-icon-main"></div>
                                                    <img src="images/md-1.jpg" alt="pic">
                                                </div>
                                                <div class="media-block">
                                                    <div class="m-icon pic"></div>
                                                    <div class="icon delete-icon-main"></div>
                                                    <img src="images/md-1.jpg" alt="pic">
                                                </div>
                                                <div class="media-block">
                                                    <div class="m-icon vid"></div>
                                                    <div class="icon delete-icon-main"></div>
                                                    <img src="images/md-1.jpg" alt="pic">
                                                </div>
                                                <div class="media-block">
                                                    <div class="m-icon pic"></div>
                                                    <div class="icon delete-icon-main"></div>
                                                    <img src="images/md-1.jpg" alt="pic">
                                                </div>
                                                <div class="media-block">
                                                    <div class="m-icon vid"></div>
                                                    <div class="icon delete-icon-main"></div>
                                                    <img src="images/md-1.jpg" alt="pic">
                                                </div>
                                                
                                                --}}
                                            </div>
                                            <div class="file-quiz file-row">
                                                
                                                
                                                {{--
                                                <div class="quiz-line field-line">
                                                    <div class="f-block">
                                                        <div class="icon">
                                                            <?php include 'images/rate-ic.svg'; ?>
                                                        </div>
                                                        <p>Кнопка</p>
                                                    </div>
                                                    <div class="field-controls">
                                                        <div class="icon edit-icon" data-bs-toggle="modal" data-bs-target="#quiz-modal"></div>
                                                        <div class="icon delete-icon-main"></div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="quiz-line field-line">
                                                    <div class="f-block">
                                                        <div class="icon">
                                                            <?php include 'images/rate-ic.svg'; ?>
                                                        </div>
                                                        <p>Кнопка</p>
                                                    </div>
                                                    <div class="field-controls">
                                                        <div class="icon edit-icon" ></div>
                                                        <div class="icon delete-icon-main"></div>
                                                    </div>
                                                </div>
                                                --}}
                                            </div>
                                            <div class="file-text file-row">
                                                
                                                {{--
                                                <div class="text-line field-line">
                                                    <div class="f-block">
                                                        <div class="icon">
                                                            <?php include 'images/txt-ic.svg'; ?>
                                                        </div>
                                                        <p>Якийсь прихований текст поста, що доступпний</p>
                                                    </div>
                                                    <div class="field-controls">
                                                        <div class="icon edit-icon"></div>
                                                        <div class="icon delete-icon-main"></div>
                                                    </div>
                                                </div>
                                                <div class="text-line field-line">
                                                    <div class="f-block">
                                                        <div class="icon">
                                                            <?php include 'images/txt-ic.svg'; ?>
                                                        </div>
                                                        <p>Кнопка</p>
                                                    </div>
                                                    <div class="field-controls">
                                                        <div class="icon edit-icon"></div>
                                                        <div class="icon delete-icon-main"></div>
                                                    </div>
                                                </div>
                                                --}}
                                            </div>
                                            <div class="file-blocks file-row">
                                               {{-- 
                                                <div class="f-block">
                                                    <div class="icon">
                                                        <?php include 'images/file-ic.svg'; ?>
                                                        <div class="delete-icon-main"></div>
                                                    </div>
                                                    <p>Назва файлу.jpg</p>
                                                </div>
                                                <div class="f-block">
                                                    <div class="icon">
                                                        <?php include 'images/file-ic.svg'; ?>
                                                        <div class="delete-icon-main"></div>
                                                    </div>
                                                    <p>AdMost-Guidr.png</p>
                                                </div>
                                                <div class="f-block">
                                                    <div class="icon">
                                                        <?php include 'images/file-ic.svg'; ?>
                                                        <div class="delete-icon-main"></div>
                                                    </div>
                                                    <p>AdMost-Guidr.png</p>
                                                </div>
                                                --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="step-block for-dates">
                                        <div class="tit">Планування публікації</div>
                                        <div class="dates">
                                            <div class="inputblock date-block">
                                                <p>Вкажіть дату та час розміщення</p>
                                                <div class="inputs">
                                                    <div class="date-input icon-input">
                                                        <label for="date-1">
                                                            <img src="images/date.svg" alt="date">
                                                        </label>
                                                        <input class="form-control nulled" id="date-1" name="date-1" type="date" placeholder="ДД.ММ.РРРР" required>
                                                    </div>
                                                    <div class="time-input icon-input">
                                                        <label for="time-1">
                                                            <img src="images/time.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" id="time-1" name="time-1" type="time" placeholder="00:00" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="inputblock date-block">
                                                <p>Повтор публікації</p>
                                                <div class="inputs">
                                                    <div class="date-input icon-input">
                                                        <label for="date-2">
                                                            <img src="images/date.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" id="date-2" name="date-2" type="date" placeholder="ДД.ММ.РРРР" required>
                                                    </div>
                                                    <div class="time-input icon-input">
                                                        <label for="time-2">
                                                            <img src="images/time.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" id="time-2" name="time-2" type="time" placeholder="00:00" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="inputblock date-block">
                                                <p>Дата та час автоматичного видалення</p>
                                                <div class="inputs">
                                                    <div class="date-input icon-input">
                                                        <label for="date-3">
                                                            <img src="images/date.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" id="date-3" name="date-3" type="date" placeholder="ДД.ММ.РРРР" required>
                                                    </div>
                                                    <div class="time-input icon-input">
                                                        <label for="time-3">
                                                            <img src="images/time.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" id="time-3" name="time-3" type="time" placeholder="00:00" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="step-block settings">
                                        <div class="tit">Налаштування</div>
                                        <div class="fields-block">
                                            <div class="settings-line">
                                                <label for="notifications-check">Сповіщення</label>
                                                <input id="notifications-check" name="notifications" type="checkbox" checked>
                                            </div>
                                            <div class="settings-line">
                                                <label for="place-check">Закріпити</label>
                                                <input id="place-check" name="place" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="step-block settings">
                                        <div class="tit">Тип поста</div>
                                        <div class="fields-block">
                                            
                                            <select name="type" required>
                                                <option value=""></option>
                                                <option value="1">Изображение и описание</option>
                                                <option value="2">Группа изображений и описание</option>
                                                <option value="3">Изображение и кнопки(ссылки)</option>
                                                <option value="4">Опрос и описание</option>
                                                <option value="5">Простое сообщение</option>
                                                <option value="6">Документ</option>
                                            </select>
                                            
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
                                    <p>Запланувати публікацію</p>
                                    <div class="icon ms-2 fill-inherit">
                                        <?php include 'images/calendar.svg'; ?>
                                    </div>
                                </button>
                            </div>
                            
                            </form>
                            
                            @endif
                            
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