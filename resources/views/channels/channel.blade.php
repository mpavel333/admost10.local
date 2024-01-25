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
                                                <div class="min-tit">{{ __('text.text_205') }}</div>
                                                <div class="txt">Публічна персона</div>
                                            </div>
                                            <div class="t-block">
                                                <div class="min-tit">{{ __('text.text_206') }}</div>
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
                                    <p>{{ __('text.text_207') }}</p>
                                </div>
                                <div class="s-block">
                                    <div class="number">23.5 М</div>
                                    <p>{{ __('text.text_208') }}</p>
                                </div>
                                <div class="s-block">
                                    <div class="number">10 К</div>
                                    <p>{{ __('text.text_209') }}</p>
                                </div>
                                <div class="s-block">
                                    <div class="number">23%</div>
                                    <p>{{ __('text.text_210') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="channel-pages white-block">
                        <div class="links-wrapper">
                            <div class="links">
                                <div class="link">
                                    <a class="active">{{ __('text.text_211') }}</a>
                                </div>
                                {{--
                                <div class="link">
                                    <a href="#">{{ __('text.text_212') }}</a>
                                </div>
                                <div class="link">
                                    <a href="#">{{ __('text.text_213') }}</a>
                                </div>
                                --}}
                            </div>
                        </div>
                        <div class="steps">
                        
                        @if(Auth::guest())
                            <br />
                            <p>{{ __('text.text_214') }} <a href="{{route('login')}}">{{ __('text.text_215') }}</a></p>
                        
                        @endif
                        
                        
                        @if(Auth::user())
                        
                        <form id="form_publication" action="{{ route('user.orders.add.submit') }}" method="post">
                            @csrf
                                <div class="s-row">
                                    <div class="step-block">
                                        <div class="s-tit">{{ __('text.text_216') }}</div>
                                        <div class="tit">{{ __('text.text_217') }}</div>
                                        <div class="radioboxes">
                                            
                                            @foreach ($tariffs as $tariff)
                                            
                                            <div class="radiobox">
                                                <input class="nulled" type="radio" name="tariff_id" id="tr-{{$tariff->id}}" value="{{$tariff->id}}">
                                                <label for="tr-{{$tariff->id}}">
                                                    <p>{{$tariff->format}}</p>
                                                    <div class="price">
                                                        <span>{{$tariff->price}}</span> {{ __('text.text_20') }}
                                                    </div>
                                                </label>
                                            </div>                                            
                                            
                                            
                                            @endforeach 
                                            

                                            
                                        </div>
                                        <div class="info">{{ __('text.text_218') }}</div>
                                    </div>
                                    <div class="step-block for-dates">
                                        <div class="s-tit">{{ __('text.text_219') }}</div>
                                        <div class="tit">{{ __('text.text_145') }}</div>
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
                                                <p>{{ __('text.text_220') }}</p>
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
                                        </div>
                                        <div class="info">{{ __('text.text_218') }}</div>
                                    </div>
                                    <div class="step-block message">
                                        <div class="s-tit">{{ __('text.text_221') }}</div>
                                        <div class="tit">{{ __('text.text_222') }}</div>
                                        <div class="inputblock">
                                            <input type="text" placeholder="{{ __('text.text_161') }}" name="link" class="form-control">
                                        </div>
                                        <div class="inputblock message-field">
                                            <textarea class="form-control" name="message" placeholder="{{ __('text.text_222') }}"></textarea>
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
                                                                    <?php include 'images/img-ic.svg'; ?>
                                                                </div>
                                                                <p>{{ __('text.text_166') }}</p>
                                                            </a>
                                                        </div>
                                                        <div class="link">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#text-modal">
                                                                <div class="icon fill-inherit">
                                                                    <?php include 'images/link-ic.svg'; ?>
                                                                </div>
                                                                <p>{{ __('text.text_167') }}</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="info">{{ __('text.text_218') }}</div>
                                    
                                        <div class="for-files">
    
                                            <div class="file-media file-row"></div>
                                            <div class="file-blocks file-row"></div>
                                            <div class="file-quiz file-row"></div>
                                            <div class="file-links file-row"></div>
                                            <div class="file-text file-row"></div>
    
                                        
                                        </div>                                    
                                    
                                    </div>
                                    
                                    <div class="step-block"></div>
                                    
                                    <div class="step-block"></div>
                                    
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
                                
                                
                                


                                <div class="for-btn text-center mt-4">
                                    <button type="submit" class="cl-btn big">
                                        <p>{{ __('text.text_143') }}</p>
                                        <div class="icon ms-2">
                                            <?php include 'images/arr-top-right.svg'; ?>
                                        </div>
                                    </button>
                                </div>
                            
                                <input type="hidden" name="channel_id" class="channels_id" value="{{ $channel->id }}"/>

                                <input type="hidden" id="hide_text" name="hide_text" value=""/>
                                
                                
                                
                                <div id="files"></div>                               
                                <div id="question"></div> 
                                <div id="links"></div>                                  
                                
                                
                                
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