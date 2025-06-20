<!-- Media modal -->
<div class="modal fade file-modal" id="photo-video-modal" tabindex="-1" role="dialog" ,aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="title">{{ __('text.text_163') }}</div>
            <form id="form_media_dropzone" method="post" action="{{ route('user.file.add') }}"  class="media-dropzone dropzone-form">
                @csrf
                <div class="open-upload-prompt" id="media_dropzone">
                    {{ __('text.text_187') }}
                </div>

                <hr class="mb-0">
                <div class="file-media file-row mb-0"></div>
                <div class="for-btn">
                    <button class="cl-btn big" type="submit">
                        {{ __('text.text_188') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- File modal -->
<div class="modal fade file-modal" id="file-modal" tabindex="-1" role="dialog" ,aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="title">{{ __('text.text_164') }}</div>
            <form id="form_files_dropzone" method="post" action="{{ route('user.file.add') }}" class="file-dropzone dropzone-form">
                <div class="open-upload-prompt">
                    {{ __('text.text_187') }}
                </div>

                <hr class="mb-0">
                <div class="file-blocks file-row mb-0"></div>
                <div class="for-btn">
                    <button class="cl-btn big" type="submit">
                        {{ __('text.text_189') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Quiz modal -->
<div class="modal fade file-modal" id="quiz-modal" tabindex="-1" role="dialog" ,aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="title">{{ __('text.text_165') }}</div>
            <form id="form_question" method="post">
                <div class="modal-blocks">
                    <div class="modal-block">
                        <div class="tit">{{ __('text.text_190') }}</div>
                        <div class="inputblock">
                            <input type="text" placeholder="{{ __('text.text_191') }}" name="question" value="<?php echo (isset($question))? $question->question : ''; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-block">
                        <div class="tit">{{ __('text.text_192') }}</div>
                        <div class="fields-block">
                            <div class="all-variants">
                            
                            <?php if($question && $question->variant){
                                foreach($question->variant as $key=>$value){ ?>
                                    
                                    <div class="inputblock clone-block removable clone-block-variant<?php echo $key ?> filled">
                                        <div class="delete-icon-main" onclick="DeleteLink('variant<?php echo $key ?>')"></div>
                                        <input class="clone-input variant-variant<?php echo $key ?>" name="variant[]" value="<?php echo $value ?>" placeholder="Варіант" type="text" required="" btn_link_id="variant<?php echo $key ?>">
                                    </div>
                                        
                                <?php                                    
                                        
                                    }
                                }?>

                            </div>
                            <a class="cl-btn w-100 new-clone-btn" href="#" data-wrapper=".all-variants" data-template=".variants-template">
                                <div class="icon">
                                    <?php include 'images/plus.svg'; ?>
                                </div>
                                <p class="text-start">{{ __('text.text_193') }}</p>
                            </a>
                        </div>
                    </div>
                    <div class="modal-block">
                        <div class="fields-block">
                            <div class="settings-line">
                                <label for="anonim-check-1">{{ __('text.text_194') }}</label>
                                <input id="anonim-check-1" name="anonim" type="checkbox" <?php echo ($question->anonim==1)? 'checked' : ''; ?>>
                            </div>
                            <div class="settings-line">
                                <label for="variant-1">{{ __('text.text_195') }}</label>
                                <input id="variant-1" name="several" type="checkbox" <?php echo ($question->several==1)? 'checked' : ''; ?>>
                            </div>
                            <div class="settings-line">
                                <label for="vic-1">{{ __('text.text_196') }}</label>
                                <input id="vic-1" name="quiz" type="checkbox" <?php echo ($question->quiz==1)? 'checked' : ''; ?>>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="for-btn">
                    <button class="cl-btn big" type="submit">
                        {{ __('text.text_197') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Links modal -->
<div class="modal fade file-modal" id="links-modal" tabindex="-1" role="dialog" ,aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="title">{{ __('text.text_105') }}</div>
            <form id="form_links" method="post">
                <div class="modal-blocks">
                    <div class="modal-block">
                        <div class="fields-links">
                            <div class="all-links">
                            
                            
                                   <?php if($links){
                                        foreach($links->links as $key=>$value){ ?>
                                        
                                            <div class="inputblock clone-block removable clone-block-<?php echo $key ?> filled">
                                                    <div class="delete-icon-main" onclick="DeleteLink('<?php echo $key ?>')"></div>
                                                    <input class="clone-input links_<?php echo $key ?>" name="links[]" value="<?php echo $value ?>" placeholder="Ссылка" type="text" required="" btn_link_id="<?php echo $key ?>">
                                                    <input class="clone-input links_text_<?php echo $key ?>" name="links_text[]" value="<?php echo $links->links_text[$key] ?>" placeholder="Текст ссылки" type="text" required="" btn_link_id="<?php echo $key ?>">
                                            </div>                                      
                                        
                                        <?php } ?>
                                    <?php } ?>                            
                            

                            </div>
                            <a class="cl-btn w-100 new-clone-btn" href="#" data-wrapper=".all-links" data-template=".links-template">
                                <div class="icon">
                                    <?php include 'images/plus.svg'; ?>
                                </div>
                                <p class="text-start">{{ __('text.text_198') }}</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="for-btn">
                    <button class="cl-btn big" type="submit">
                        {{ __('text.text_199') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Text modal -->
<div class="modal fade file-modal" id="text-modal" tabindex="-1" role="dialog" ,aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="title">{{ __('text.text_167') }}</div>
            <form id="form_hide_text" method="post">
                <div class="modal-blocks">
                    <div class="modal-block">
                        <div class="inputblock">
                            <textarea placeholder="{{ __('text.text_200') }}" name="hide_text" class="form-control" required>{{ $publication->hide_text }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="for-btn">
                    <button class="cl-btn big" type="submit">
                        {{ __('text.text_201') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Deny modal -->
<div class="modal fade deny-modal min-modal" id="deny-modal" tabindex="-1" role="dialog" ,aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="title">Відхилення заявки</div>
            <form action="" method="post">
                <div class="modal-blocks">
                    <div class="modal-block">
                        <div class="tit">Вкажіть причину</div>
                        <div class="inputblock format-block text-input">
                            <input class="form-control" name="reason" placeholder="Вкажіть причину" type="text" required>
                            <div class="check"></div>
                        </div>
                    </div>
                    <div class="modal-block">
                        <div class="tit">Вкажіть дату та час розміщення</div>
                        <div class="inputblock date-block">
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
                    </div>
                </div>
                <div class="for-btn">
                    <button class="cl-btn big" type="submit">
                        Підтвердити
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Deny modal -->
<div class="modal fade comment-modal min-modal" id="comment-modal" tabindex="-1" role="dialog" ,aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="title">Коментар</div>
            <form action="" method="post">
                <div class="modal-blocks">
                    <div class="modal-block">
                        <div class="tit">Напишіть Ваш комментар</div>
                        <div class="inputblock">
                            <textarea class="form-control" name="comment" placeholder="Коментар" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="for-btn">
                    <button class="cl-btn big" type="submit">
                        Відправити
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>






<!-- Preview modal -->
<div class="modal fade filters-modal min-modal" id="filters-modal" tabindex="-1" role="dialog" ,aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-head">
                <div class="title">Фільтрація</div>
            </div>
            <div class="modal-filters"></div>
        </div>
    </div>
</div>

<!-- Variants template -->
<template class="variants-template">
    <div class="inputblock clone-block removable">
        <div class="delete-icon-main"></div>
        <input class="clone-input" name="variant[]" placeholder="{{ __('text.text_202') }}" type="text" required>
    </div>
</template>

<!-- Links template -->
<template class="links-template">
    <div class="inputblock clone-block removable">
        <div class="delete-icon-main"></div>
        <input class="clone-input" name="links[]" placeholder="{{ __('text.text_105') }}" type="text" required>
        <input class="clone-input" name="links_text[]" placeholder="{{ __('text.text_203') }}" type="text" required>
    </div>
</template>