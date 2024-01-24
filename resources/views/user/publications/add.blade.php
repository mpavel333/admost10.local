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
                                        <div class="inputblock">
                                            <input type="text" placeholder="{{ __('text.text_161') }}" name="link" class="form-control" required="">
                                        </div>
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
                                            </div>
                                            <div class="inputblock date-block">
                                                <p>{{ __('text.text_171') }}</p>
                                                <div class="inputs">
                                                    <div class="date-input icon-input">
                                                        <label for="date-2">
                                                            <img src="images/date.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" id="date-2" name="date-2" type="date" placeholder="{{ __('text.text_170') }}" required>
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
                                                <p>{{ __('text.text_172') }}</p>
                                                <div class="inputs">
                                                    <div class="date-input icon-input">
                                                        <label for="date-3">
                                                            <img src="images/date.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" id="date-3" name="date-3" type="date" placeholder="{{ __('text.text_170') }}" required>
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
                                        </div>
                                    </div>
                                    
                                    
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