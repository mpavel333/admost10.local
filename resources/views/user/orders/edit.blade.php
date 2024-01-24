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
 
 <?php //print_r($channel) ?>
                
                <div class="panel-main channel-inner">
                    <div class="channel-info white-block">
                        <div class="photo">
                            <img src="@if($channel->image)images\channels\{{$channel->image}}@else images\channels\no-image.png @endif" alt="photo">
                        </div>
                        <div class="info-summary">
                            <div class="is-top">
                                <div class="name">
                                    <p>{{ $channel->name}}</p>
                                    <div class="icon">
                                        <img src="images/verified.svg" alt="verified">
                                    </div>
                                </div>
                                <div class="link">
                                    <a class="cl-btn dark-bd-btn w-auto" href="{{ $channel->link }}" target="_blank">
                                        {{ $channel->link }}
                                    </a>
                                </div>
                            </div>
                            <!-- statistic mobile -->
                            <div class="statistic-mobile d-ld-none"></div>
                            <div class="is-bottom">
                                <div class="row g-0">
                                    <div class="col-12 col-md-8">
                                        <div class="text">
                                            {{ $channel->description}}
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
                                    <a class="active" href="#">Покупка реклами</a>
                                </div>
                                <div class="link">
                                    <a href="#">Аналітика каналу</a>
                                </div>
                                <div class="link">
                                    <a href="#">Відгуки</a>
                                </div>
                            </div>
                        </div>
                        <div class="steps">
                        
                        @if(Auth::guest())
                            <br />
                            <p>Для покупки рекламы необходима <a href="{{route('login')}}">авторизация</a></p>
                        
                        @endif
                        
                        
                        @if(Auth::user())
                        
                        <form id="form_publication" action="{{ route('user.orders.edit.submit',$publication->id) }}" method="post">
                            @csrf
                                <div class="s-row">
                                    <div class="step-block">
                                        <div class="s-tit">Крок 1</div>
                                        <div class="tit">Оберіть тариф</div>
                                        <div class="radioboxes">
                                            
                                            @foreach ($tariffs as $tariff)
                                            
                                            <div class="radiobox">
                                                <input class="nulled" type="radio" name="tariff_id" id="tr-{{$tariff->id}}" value="{{$tariff->id}}">
                                                <label for="tr-{{$tariff->id}}">
                                                    <p>{{$tariff->format}}</p>
                                                    <div class="price">
                                                        <span>{{$tariff->price}}</span> грн
                                                    </div>
                                                </label>
                                            </div>                                            
                                            
                                            
                                            @endforeach 
                                            
                                            <script type="text/javascript">document.getElementById("tr-{{$publication->tariff_id}}").checked = true;</script>
                                            
                                            {{--
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
                                            
                                            --}}
                                            
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
                                                        <input class="form-control nulled" id="date-1" name="date-1" type="text" value="<?php echo date('d.m.Y',strtotime($publication->published)) ?>" placeholder="ДД.ММ.РРРР" required>
                                                    </div>
                                                    <div class="time-input icon-input">
                                                        <label for="time-1">
                                                            <img src="images/time.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" id="time-1" name="time-1" type="text" value="<?php echo date('H:i',strtotime($publication->published)) ?>" placeholder="00:00" required>
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
                                                        <input class="form-control" id="date-2" name="date-2" type="text" value="<?php echo date('d.m.Y',strtotime($publication->answer)) ?>" placeholder="ДД.ММ.РРРР" required>
                                                    </div>
                                                    <div class="time-input icon-input">
                                                        <label for="time-2">
                                                            <img src="images/time.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" id="time-2" name="time-2" type="text" value="<?php echo date('H:i',strtotime($publication->answer)) ?>" placeholder="00:00" required>
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
                                            <input type="text" placeholder="Посилання на канал або ресурс" name="link" class="form-control" value="{{ $publication->link }}">
                                        </div>
                                        <div class="inputblock message-field">
                                            <textarea class="form-control" name="message" placeholder="Рекламне повідомлення">{{ $publication->message }}</textarea>
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
                                    
                                        <div class="for-files">
    
                                            <div class="file-media file-row">
                                            
                                                @if($publication->media)
                                                
                                                <?php //print_r($publication->files) ?>
                                                
                                                @foreach($publication->media as $media)
                                                
                                                
                                                <div class="media-block" id="media-block-{{$media->file_id}}">
                                                    <div class="m-icon pic"></div>
                                                    <a class="icon delete-icon-main" onclick="DeleteFile({{$media->file_id}})"></a>
                                                    <img src="{{$media->path}}/{{$media->filename}}" alt="pic">
                                                </div>
                                                                                            
                                                
                                                @endforeach
                                                
                                                @endif                                              
                                            
                                            </div>
                                            <div class="file-blocks file-row">
                                            
                                            
@if($publication->files)

<?php //print_r($publication->files) ?>

@foreach($publication->files as $file)
                                            
<div class="f-block" id="f-block-{{$file->file_id}}">
    <div class="icon">
    <img src="images/file-ic.svg">
    <a class="delete-icon-main" onclick="DeleteFile({{$file->file_id}})"></a>
    </div><p>{{$file->filename}}</p>
</div>                                              

@endforeach

@endif 
                                            
                                            
                                            </div>
                                            <div class="file-quiz file-row">
                                            
                                            <?php 
                                            
                                            if($publication->question) $question = json_decode($publication->question);
                                            
                                            //print_r($links);
                                             //die;
                                            
                                            if($question){ ?>
                                            
                                           
                                            
                                            
                                                <div class="quiz-line field-line">
                                                    <div class="f-block">
                                                        <div class="icon">
                                                            <?php include 'images/rate-ic.svg'; ?>
                                                        </div>
                                                        <p><?php echo $question->question ?></p>
                                                    </div>
                                                    <div class="field-controls">
                                                        <div class="icon edit-icon" data-bs-toggle="modal" data-bs-target="#quiz-modal"></div>
                                                        <div class="icon delete-icon-main" onclick="DeleteQuestion();"></div>
                                                    </div>
                                                </div>                                            
                                            
                                            <?php } ?>                                             
                                            
                                            </div>
                                            <div class="file-links file-row">
                                            
                                            <?php 
                                            
                                            if($publication->links) $links = json_decode($publication->links);
                                            
                                            //print_r($links);
                                             //die;
                                            
                                            foreach($links->links as $key=>$value){ ?>
                                            

                                                <div id="links_line_<?php echo $key ?>" class="link-line field-line">
                                                    <div class="f-block">
                                                        <div class="icon">
                                                            <?php include 'images/link-ic.svg'; ?>
                                                        </div>
                                                        <p><?php echo $links->links_text[$key] ?></p>
                                                    </div>
                                                    <div class="field-controls">
                                                        <div class="icon edit-icon" data-bs-toggle="modal" data-bs-target="#links-modal"></div>
                                                        <div class="icon delete-icon-main" onclick="DeleteLink('<?php echo $key ?>');"></div>
                                                    </div>
                                                </div>
                                            
                                            
                                            <?php } ?>                                            
                                            
                                            </div>
                                            <div class="file-text file-row">
                                            
                                                @if($publication->hide_text)                                                
                                                    <div id="text-line" class="text-line field-line">
                                                        <div class="f-block"><div class="icon"><img src="images/txt-ic.svg"></div><p>{{$publication->hide_text}}</p></div>
                                                        <div class="field-controls">
                                                        <div class="icon edit-icon" data-bs-toggle="modal" data-bs-target="#text-modal"></div>
                                                        <div class="icon delete-icon-main" onclick="DeleteHideText();"></div></div>
                                                    </div>                                                
                                                @endif 
                                            
                                            </div>
    
                                        
                                        </div>                                    
                                    
                                    </div>
                                    
                                    <div class="step-block"></div>
                                    
                                    <div class="step-block"></div>
                                    
                                    <div class="step-block settings">
                                        <div class="tit">Тип поста</div>
                                        <div class="fields-block">
                                            
                                            <select id="type" name="type" required>
                                                <option value=""></option>
                                                <option value="1">Изображение и описание</option>
                                                <option value="2">Группа изображений и описание</option>
                                                <option value="3">Изображение и кнопки(ссылки)</option>
                                                <option value="4">Опрос и описание</option>
                                                <option value="5">Простое сообщение</option>
                                                <option value="6">Документ</option>
                                            </select>
                                            <script type="text/javascript">document.getElementById("type").value = '{{$publication->type}}';</script>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                
                                
                                


                                <div class="for-btn text-center mt-4">
                                    <button type="submit" class="cl-btn big">
                                        <p>Відправити на модерацію</p>
                                        <div class="icon ms-2">
                                            <?php include 'images/arr-top-right.svg'; ?>
                                        </div>
                                    </button>
                                </div>
                            
                                <input type="hidden" name="channel_id" class="channels_id" value="{{ $channel->id }}"/>

                                <input type="hidden" id="hide_text" name="hide_text" value=""/>
                                
                                
                                
                                <div id="files"></div> 
                                <div id="del_files"></div>                              
                                <div id="question"></div> 
                                                               
                                
      
                                <div id="links">
                                   <?php if($publication->links){
                                        foreach($links->links as $key=>$value){ ?>
                                            <input id="links_<?php echo $key ?>" type="hidden" name="links[]" value="<?php echo $value ?>">
                                            <input id="links_text_<?php echo $key ?>" type="hidden" name="links_text[]" value="<?php echo $links->links_text[$key] ?>">
                                        <?php } ?>
                                    <?php } ?>
                                </div>                                 
                                
                                <div id="question">


                            <?php if($question){
                                
                                //print_r($question->variant);
                                foreach($question as $key=>$value){
                                
                                    if($key=='variant'){
                                        foreach($question->variant as $key2=>$value){
                                            
                                            echo '<input type="hidden" name="question['.$key.'][]" value="'.$value.'">';
                                            
                                        }
                                    }else{
                                        echo '<input type="hidden" name="question['.$key.']" value="'.$value.'">';
                                    }
                                  
                                    
                                }
                            }
                            ?>                                
                                
                                </div>
                                
                                <input type="hidden" id="hide_text" name="hide_text" value="{{ $publication->hide_text }}"/> 
      
                                <input class="channels_id" type="hidden" name="channel_id" value="{{ $publication->channel_id }}">
                                
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