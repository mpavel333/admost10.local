<!-- Media modal -->
<div class="modal fade file-modal" id="photo-video-modal" tabindex="-1" role="dialog" ,aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="title">Фото/Відео</div>
            <form id="form_media_dropzone" method="post" action="{{ route('user.file.add') }}"  class="media-dropzone dropzone-form">
                @csrf
                <div class="open-upload-prompt" id="media_dropzone">
                    Перетягніть файли у цю область
                </div>

                <hr class="mb-0">
                <div class="file-media file-row mb-0"></div>
                <div class="for-btn">
                    <button class="cl-btn big" type="submit">
                        Завантажити медіа
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
            <div class="title">Файл</div>
            <form id="form_files_dropzone" method="post" action="{{ route('user.file.add') }}" class="file-dropzone dropzone-form">
                <div class="open-upload-prompt">
                    Перетягніть файли у цю область
                </div>

                <hr class="mb-0">
                <div class="file-blocks file-row mb-0"></div>
                <div class="for-btn">
                    <button class="cl-btn big" type="submit">
                        Завантажити файли
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
            <div class="title">Фото/Відео</div>
            <form action="" method="post">
                <div class="modal-blocks">
                    <div class="modal-block">
                        <div class="tit">Запитання</div>
                        <div class="inputblock">
                            <input type="text" placeholder="Поставте запитання" name="question" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-block">
                        <div class="tit">Запитання</div>
                        <div class="fields-block">
                            <div class="all-variants">
                                <div class="inputblock clone-block removable">
                                    <div class="delete-icon-main"></div>
                                    <input class="clone-input" name="variant" placeholder="Варіант" type="text" required>
                                </div>
                            </div>
                            <a class="cl-btn w-100 new-clone-btn" href="#" data-wrapper=".all-variants" data-template=".variants-template">
                                <div class="icon">
                                    <?php include 'images/plus.svg'; ?>
                                </div>
                                <p class="text-start">Додати інший варіант</p>
                            </a>
                        </div>
                    </div>
                    <div class="modal-block">
                        <div class="fields-block">
                            <div class="settings-line">
                                <label for="anonim-check-1">Анонімне голосувння</label>
                                <input id="anonim-check-1" name="notifications" type="checkbox">
                            </div>
                            <div class="settings-line">
                                <label for="variant-1">Вибір декількох варіантів</label>
                                <input id="variant-1" name="place" type="checkbox">
                            </div>
                            <div class="settings-line">
                                <label for="vic-1">Режим вікторини</label>
                                <input id="vic-1" name="place" type="checkbox">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="for-btn">
                    <button class="cl-btn big" type="submit">
                        Завантажити медіа
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
            <div class="title">Посилання</div>
            <form action="" method="post">
                <div class="modal-blocks">
                    <div class="modal-block">
                        <div class="fields-links">
                            <div class="all-links">
                                <div class="inputblock clone-block removable">
                                    <div class="delete-icon-main"></div>
                                    <input class="clone-input" name="link" placeholder="Посилання" type="text" required>
                                    <input class="clone-input" name="link-text" placeholder="Текст посилання" type="text" required>
                                </div>
                            </div>
                            <a class="cl-btn w-100 new-clone-btn" href="#" data-wrapper=".all-links" data-template=".links-template">
                                <div class="icon">
                                    <?php include 'images/plus.svg'; ?>
                                </div>
                                <p class="text-start">Додати інший варіант</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="for-btn">
                    <button class="cl-btn big" type="submit">
                        Зберегти і додати посилання
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
            <div class="title">Прихований текст</div>
            <form action="" method="post">
                <div class="modal-blocks">
                    <div class="modal-block">
                        <div class="inputblock">
                            <textarea placeholder="Текст, що не доступний для непідписників" name="question" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="for-btn">
                    <button class="cl-btn big" type="submit">
                        Додати прихований текст
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
        <input class="clone-input" name="variant" placeholder="Варіант" type="text" required>
    </div>
</template>

<!-- Links template -->
<template class="links-template">
    <div class="inputblock clone-block removable">
        <div class="delete-icon-main"></div>
        <input class="clone-input" name="link" placeholder="Посилання" type="text" required>
        <input class="clone-input" name="link-text" placeholder="Текст посилання" type="text" required>
    </div>
</template>