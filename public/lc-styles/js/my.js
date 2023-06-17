$(document).ready(function () {


    var emailBodyConfig = {
        selector: 'textarea#description',
        menubar: false,
        inline: true,
        plugins: [
            'link',
            'lists',
            'powerpaste',
            'autolink',
            'tinymcespellchecker'
        ],
        toolbar: [
            'undo redo | bold italic underline | fontselect fontsizeselect',
            'forecolor backcolor | alignleft aligncenter alignright alignfull | numlist bullist outdent indent'
        ],
        valid_elements: 'p[style],strong,em,span[style],a[href],ul,ol,li',
        valid_styles: {
            '*': 'font-size,font-family,color,text-decoration,text-align'
        },
        powerpaste_word_import: 'clean',
        powerpaste_html_import: 'clean',
    };

    tinymce.init(emailBodyConfig);


    /* enable transition */
    $('body').removeClass('transition-off');

    /* close/open menu */
    $('.hamburger').click(function () {
        $('.mobile-menu, .hamburger').toggleClass('active');
        $('body').toggleClass('overflow-hidden');
    });

    if ($(window).width() < 1200) {
        $('.mobile-slide').each(function () {
            let block = $(this),
                dropdown = block.find('.dropdown-default'),
                control = block.find('.control-select');

            control.click(function () {
                block.toggleClass('active');

                dropdown.slideToggle();
            });

        });
    }

    /* range slider */
    $('.range-filter').each(function () {
        let range = $(this),
            rangeInput = range.find('.range-input'),
            rangeFrom = range.find('.range-from'),
            rangeTo = range.find('.range-to'),
            dropdown = range.parents('.range-dropdown-link');

        rangeInput.ionRangeSlider({

            // onStart: function (data) {
            //     $('.subscribers-slider .count').text(data.from_pretty);
            // },

            onChange: function (data) {
                rangeFrom.val(data.from_pretty);
                rangeTo.val(data.to_pretty);

                if (dropdown) {
                    dropdown.find('.control-select').addClass('active');
                }
            },

        });
    });

    // favorites
    $('.favorite').each(function () {
        const block = $(this);

        block.click(function () {
            block.toggleClass('active');
        });
    });

    // chat modal activating
    $('.chat-modal').each(function () {
        const previewModal = $(this).find('.preview-modal-block');
        const closeBtn = $(previewModal).find('.btn-close');
        const openBtn = $(this).find('.preview-icon');
        const chatBlock = $(this).find('.for-chat');
        const modal = $(this);

        closeBtn.click(function () {
            previewModal.removeClass('active');
            openBtn.removeClass('active');

            setTimeout(() => {
                modal.removeClass('active');
            }, 500);
        });

        openBtn.click(function () {
            previewModal.toggleClass('active');
            openBtn.toggleClass('active');
            modal.toggleClass('active');

            // if(modal.hasClass('active')) {
            //     setTimeout(() => {
            //         modal.removeClass('active');
            //     }, 500);
            // }
            // else {
            //     modal.addClass('active');
            // }

        });
    });


    // add class to parent block of collapse
    const collapses = document.querySelectorAll('.collapse-block');

    if (collapses) {
        collapses.forEach(function (block) {
            let collapse = block.querySelector('.collapse');

            collapse.addEventListener('show.bs.collapse', event => {
                block.classList.add('active');
            });

            collapse.addEventListener('hide.bs.collapse', event => {
                block.classList.remove('active');
            });
        })
    }

    // copy to clipboard
    const copyBlocks = document.querySelectorAll('.copy-block');

    if (copyBlocks) {
        copyBlocks.forEach(function (block) {
            const copyBtn = block.querySelector('.icon');
            const copyInput = block.querySelector('input');

            copyBtn.addEventListener('click', (e) => {
                copyInput.select();
                document.execCommand('copy');

                block.classList.add('active');

                setTimeout(() => {
                    block.classList.remove('active');

                    let emptySelection = window.getSelection();
                    emptySelection.removeAllRanges();
                }, 1000);
            });

        });
    }

});

let mediaDropzoneExist = 0;
// media dropbox
function mediaDropzone() {
    const formClass = document.querySelector('.media-dropzone');
    const filesBlock = formClass.querySelector('.file-media');
    const uploadArea = formClass.querySelector('.open-upload-prompt');

    // Dropzone configuration
    let dropzoneConfig = {
        url: 'handler.php',
        dictDefaultMessage: "Drop documents here (or click) to capture/upload.",
        clickable: uploadArea,
        timeout: "360000",
        // chunking: true,
        uploadMultiple: true,
        maxFilesize: 400000000,
        chunkSize: 1000000,
        parallelChunkUploads: true,
        autoProcessQueue: true,
        parallelUploads: 1,
        addRemoveLinks: true,
        previewsContainer: filesBlock,
        acceptedFiles: 'image/jpg'
    };

    // Initialize Dropzone
    mediaDropzoneExist = new Dropzone(formClass, dropzoneConfig);
}

let fileDropzoneExist = 0;
// file dropbox
function fileDropzone() {
    const formClass = document.querySelector('.file-dropzone');
    const filesBlock = formClass.querySelector('.file-blocks');
    const uploadArea = formClass.querySelector('.open-upload-prompt');

    // Dropzone configuration
    let dropzoneConfig = {
        url: 'handler.php',
        dictDefaultMessage: "Drop documents here (or click) to capture/upload.",
        clickable: uploadArea,
        timeout: "360000",
        // chunking: true,
        uploadMultiple: true,
        maxFilesize: 400000000,
        chunkSize: 1000000,
        parallelChunkUploads: true,
        autoProcessQueue: true,
        parallelUploads: 1,
        addRemoveLinks: true,
        previewsContainer: filesBlock,
        acceptedFiles: 'application/pdf'
    };

    // Initialize Dropzone
    fileDropzoneExist = new Dropzone(formClass, dropzoneConfig);
}

// media modal
$(document).on('shown.bs.modal', '#photo-video-modal', function () {
    if (!mediaDropzoneExist) mediaDropzone();
});

// file modal
$(document).on('shown.bs.modal', '#file-modal', function () {
    if (!fileDropzoneExist) fileDropzone();
});

$(window).on('load resize', function () {
    /** Move blocks on resize **/

    // balance
    appendBlocks('.balance-move', 0, 1199, '.mobile-menu .other-blocks');
    appendBlocks('.balance-move', 1199, 0, '.h-settings');

    // languages
    appendBlocks('.languages-move', 0, 1199, '.mobile-menu .other-blocks');
    appendBlocks('.languages-move', 1199, 0, '.h-settings');

    // notification
    appendBlocks('.notification-move', 0, 1199, '.notification-mobile');
    appendBlocks('.notification-move', 1199, 0, '.h-settings');

    // account
    appendBlocks('.account-move', 0, 1199, '.account-mobile');
    appendBlocks('.account-move', 1199, 0, '.h-settings');

    // tech menu
    appendBlocks('.tech-menu-move', 0, 1199, '.for-menu');
    appendBlocks('.tech-menu-move', 1199, 0, '.for-tech-menu');

    // main menu
    appendBlocks('.panel-menu-move', 0, 1199, '.for-menu');
    appendBlocks('.panel-menu-move', 1199, 0, '.for-panel-menu');

    // main menu
    appendBlocks('.statistic-move', 0, 991, '.statistic-mobile');
    appendBlocks('.statistic-move', 991, 0, '.statistic-wrapper');

    // filters
    appendBlocks('.filter-move', 0, 1199, '.modal-filters');
    appendBlocks('.filter-move', 1199, 0, '.filter-dropdowns');

    //---------------------------------//
});

function appendBlocks(block, windowMin, windowMax, appendTo) {
    var exists = $(appendTo).find(block)
    if (!exists.length) {
        if (windowMax == 0) {
            if ($(window).width() > windowMin) {
                $(block).appendTo($(appendTo));
            }
        } else {
            if ($(window).width() > windowMin && $(window).width() < windowMax) {
                $(block).appendTo($(appendTo));
            }
        }
    }
}


// youtube video multiple load
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var players = new Array();

$(document).ready(function () {

    $(document).on('click', '.cl9-toggle-play', function () {
        var playBtn = $(this);
        var plBlock = playBtn.closest('.video-bl');
        var videoBlockId = plBlock.find('.embed-responsive-item').attr('id');

        playBtn.addClass('in-process');

        // Сначала останавливаем все плееры
        $(players).each(function () {
            let state = this.getPlayerState();

            if (state === 1) {
                this.pauseVideo();
            }

            $('#' + this.videoBlockId).closest('.video-bl').find('.cl9-toggle-play').removeClass('c-hide');
        });

        // Если плеер уже инициализирован
        if (plBlock.find('iframe').length) {
            $(players).each(function () {
                if (this.videoBlockId == videoBlockId) {
                    var state = this.getPlayerState();

                    if (state === 1) {
                        this.pauseVideo();
                        playBtn.removeClass('c-hide');
                    } else {
                        playBtn.addClass('c-hide');
                        this.playVideo();
                    }
                }
            });
            playBtn.removeClass('in-process');

            // Иначе инициализируем
        } else {
            $('.video-bl').addClass('pointer');

            var videoID = plBlock.data('video');

            var player = new YT.Player(videoBlockId, {
                playerVars: {
                    'controls': 0,
                    'showinfo': 0,
                    'rel': 0,
                    'autoplay': 0,
                    'playsinline': 1,
                },
                videoId: videoID,
                events: {
                    'onReady': onPlayerReady,
                },

            });

            player.videoBlockId = videoBlockId;

            players.push(player);

            function onPlayerReady() {

                plBlock.removeClass('pointer');
                setTimeout(function () {
                    $('.video-bl').removeClass('pointer');
                }, 1000);

                playBtn.removeClass('in-process');
                var state = player.getPlayerState();
                if (state === 1) {
                    player.pauseVideo();
                } else {
                    player.playVideo();
                    playBtn.addClass('c-hide');
                }
            }
        }
    });
});

function onYouTubeIframeAPIReady() {
    $('.video-bl').each(function (key) {

        let videoID = $(this).data('video');
        let bgImage = $(this).data('bg');
        let videoBlockId = 'player' + key;

        if (!videoID) {
            return false;
        }

        if (bgImage) {
            var bgImageUrl = bgImage;
        } else {
            var bgImageUrl = 'https://img.youtube.com/vi/' + videoID + '/0.jpg';
        }

        $(this).html('<div class="ratio ratio-16x9"><div class="embed-responsive-item" id="' + videoBlockId + '"></div><div class="cl9-toggle-play" style="background-image: url(' + bgImageUrl + ')"><div class="play-icn"><svg width="148" height="149" viewBox="0 0 148 149" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="73.9999" cy="74.6429" r="73.7143" fill="#3162E8"/><path d="M90.8929 71.9829C92.9405 73.1651 92.9405 76.1206 90.8929 77.3028L67.8571 90.6025C65.8095 91.7846 63.25 90.3069 63.25 87.9425L63.25 61.3432C63.25 58.9788 65.8095 57.501 67.8571 58.6832L90.8929 71.9829Z" fill="white"/></svg></div></div></div>');
    });
}