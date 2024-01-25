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

                <div class="panel-main channel-new white-block">
                    <h1 class="title gap-title d-flex align-items-center">
                        <p>{{ __('text.text_247') }}</p>
                    </h1>
                    
                    
                    @include('inc.alerts')                    
                    
                    <div class="page-content">
                    
                        <div class="channel-fields">
                            {{--
                            <form action="{{ route('user.settings.submit') }}" method="post">
                                @csrf
                                <div class="f-row">
                                    <div class="info-column basic-info p-0">
                                        <div class="text-block">
                                            <div class="tit">{{ __('text.text_243') }}</div>
                                            <div class="inputblock">
                                                <input name="amount" type="text" placeholder="10000" class="form-control" onkeypress='validate(event)' required>
                                                <p class="info">{{ __('text.text_244') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="for-btn text-center add-btn-wrapper">
                                    <button type="submit" class="cl-btn big">
                                        <p>{{ __('text.text_245') }}</p>
                                        <div class="icon ms-2">
                                            <?php include 'account/images/arr-top-right.svg'; ?>
                                        </div>
                                    </button>
                                </div>
                            </form>
                            --}}
                        </div>
                    
                    </div>
                    
                </div>
                <div class="panel-banner white-block min-banner">

                </div>                  
                

            </div>
        </div>
    </div>

    <!-- all plugins -->
    @include('inc.scripts')
    <?php //include 'scripts.php'; ?>

</body>

</html>