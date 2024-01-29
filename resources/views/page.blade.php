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
                
                <?php
                
                    $Page = (array) $Page;
                    $lang = App\Http\Middleware\LocaleMiddleware::getLocale();
                    if(empty($lang)) $lang = 'ua';
                ?>
                
                
                <div class="panel-main channel-new white-block">
                    <h1 class="gap-title d-flex align-items-center">
                        <p><?php echo $Page['name_'.$lang]; ?></p>
                    </h1>
                    
                    
                    @include('inc.alerts')                    
                    
                    <div class="page-content">
                    
                   <?php echo $Page['full_desc_'.$lang]; ?>
                    
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