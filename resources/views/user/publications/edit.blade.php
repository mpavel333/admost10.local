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


                <div class="panel-main post-inner">
                    <div class="channel-pages white-block">
                        <div class="links-wrapper">
                            <div class="links channel">
                                <?php 
                                    $pub_channels = [];
                                    if($publication->channels_id) $pub_channels = json_decode($publication->channels_id);
    
                                    foreach ($channels as $channel){ 
                                    $class = '';
                                    if(in_array($channel->id,$pub_channels)) $class = 'active';    
                                    ?>
                                    <div class="link">
                                        <a class="alert <?php echo $class ?>" channel_id="{{$channel->id}}">
                                            <div class="pic">
                                                <img src="@if($channel->image)images\channels\{{$channel->image}}@else images\channels\no-image.png @endif" alt="pic">
                                            </div>
                                            <p>{{$channel->link}}</p>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="steps">
                            <form id="form_publication" action="{{ route('user.publications.edit.submit',$publication->id) }}" method="post">
                            @csrf
                                <div class="s-row">
                                    <div class="step-block message">
                                        <div class="tit">{{ __('text.text_183') }}</div>
                                        <div class="inputblock">
                                            <input type="text" placeholder="{{ __('text.text_161') }}" name="link" value="{{ $publication->link }}" class="form-control">
                                        </div>
                                        <div class="inputblock message-field">
                                            <textarea class="form-control" name="message" placeholder="{{ __('text.text_162') }}">{{ $publication->message }}</textarea>
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
                                            
                                            <?php 
                                            if($publication->links) $links = json_decode($publication->links);
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
                                            <div class="file-media file-row">
                                                <a class="cl-btn blue-l-btn" href="#" data-bs-toggle="modal" data-bs-target="#photo-video-modal">
                                                    <div class="icon">
                                                        <?php include 'images/plus.svg'; ?>
                                                    </div>
                                                </a>
                                                
                                                @if($publication->media)
                                                
                                                @foreach($publication->media as $media)

                                                    <div class="media-block" id="media-block-{{$media->file_id}}">
                                                        <div class="m-icon pic"></div>
                                                        <a class="icon delete-icon-main" onclick="DeleteFile({{$media->file_id}})"></a>
                                                        <img src="{{$media->path}}/{{$media->filename}}" alt="pic">
                                                    </div>
                                                                                            
                                                @endforeach
                                                
                                                @endif                                                  
                                                
                                            </div>
                                            <div class="file-quiz file-row">

                                            <?php 
                                            
                                            if($publication->question) $question = json_decode($publication->question);
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
                                            <div class="file-blocks file-row">
                                                
                                                @if($publication->files)
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
                                                        <input class="form-control nulled" value="<?php echo date('d.m.Y',strtotime($publication->date_published)) ?>" 
                                                        id="date-1" name="date-1" type="text" placeholder="{{ __('text.text_170') }}" required>
                                                    </div>
                                                    <div class="time-input icon-input">
                                                        <label for="time-1">
                                                            <img src="images/time.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" value="<?php echo date('H:i',strtotime($publication->date_published)) ?>" 
                                                        id="time-1" name="time-1" type="text" placeholder="00:00" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="inputblock date-block">
                                                <p>{{ __('text.text_184') }}</p>
                                                <div class="inputs">
                                                    <div class="date-input icon-input">
                                                        <label for="date-2">
                                                            <img src="images/date.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" value="<?php if($publication->date_repeat) echo date('d.m.Y',strtotime($publication->date_repeat)) ?>"
                                                        id="date-2" name="date-2" type="text" placeholder="{{ __('text.text_170') }}" >
                                                    </div>
                                                    <div class="time-input icon-input">
                                                        <label for="time-2">
                                                            <img src="images/time.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" value="<?php if($publication->date_repeat) echo date('H:i',strtotime($publication->date_repeat)) ?>"
                                                        id="time-2" name="time-2" type="text" placeholder="00:00" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="inputblock date-block">
                                                <p>{{ __('text.text_185') }}</p>
                                                <div class="inputs">
                                                    <div class="date-input icon-input">
                                                        <label for="date-3">
                                                            <img src="images/date.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" value="<?php if($publication->date_delete) echo date('d.m.Y',strtotime($publication->date_delete)) ?>"
                                                        id="date-3" name="date-3" type="text" placeholder="{{ __('text.text_170') }}" >
                                                    </div>
                                                    <div class="time-input icon-input">
                                                        <label for="time-3">
                                                            <img src="images/time.svg" alt="date">
                                                        </label>
                                                        <input class="form-control" value="<?php if($publication->date_delete) echo date('H:i',strtotime($publication->date_delete)) ?>"
                                                         id="time-3" name="time-3" type="text" placeholder="00:00" >
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
                                                <input id="notifications-check" name="notifications" type="checkbox" @if($publication->notifications) checked @endif>
                                            </div>
                                            <div class="settings-line">
                                                <label for="place-check">{{ __('text.text_174') }}</label>
                                                <input id="place-check" name="place" type="checkbox" @if($publication->place) checked @endif>
                                            </div>
                                        </div>
                                    </div>
                                
                                
                                    <div class="step-block settings">
                                        <div class="tit">{{ __('text.text_181') }}</div>
                                        <div class="fields-block">
                                            
                                            <select id="type" name="type" required>
                                                <option value=""></option>
                                                <option value="1">{{ __('text.text_175') }}</option>
                                                <option value="2">{{ __('text.text_176') }}</option>
                                                <option value="3">{{ __('text.text_177') }}</option>
                                                <option value="4">{{ __('text.text_178') }}</option>
                                                <option value="5">{{ __('text.text_179') }}</option>
                                                <option value="6">{{ __('text.text_180') }}</option>
                                            </select>
                                            <script type="text/javascript">document.getElementById("type").value = '{{$publication->type}}';</script>
                                        </div>
                                    </div>
                                
                                
                                
                                </div>

                                <div id="files"></div>   
                                <div id="del_files"></div>   
                                
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
                            
                                <div class="for-btn text-center mt-4">
                                    <button type="submit" class="cl-btn big no-stroke">
                                        <p>{{ __('text.text_186') }}</p>
                                        <div class="icon ms-2 fill-inherit">
                                            <?php include 'images/calendar.svg'; ?>
                                        </div>
                                    </button>
                                </div>
                            
                            <?php
                                if($publication->channels_id){
                                    $pub_channels = json_decode($publication->channels_id);
                                    foreach ($pub_channels as $channel){
                                        echo '<input id="channel_id_'.$channel.'" class="channels_id" type="hidden" name="channels_id[]" value="'.$channel.'">';  
                                    }
                                }                           
                            ?>
                            
                            </form>
                            
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