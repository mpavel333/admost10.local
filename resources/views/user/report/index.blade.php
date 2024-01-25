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
                    <h1 class="gap-title d-flex align-items-center">
                        <p>{{ __('text.text_239') }}:</p>
                    </h1>
                    
                    
                    @include('inc.alerts')                    
                    
                    <div class="page-content">
                    
                        <div class="report-fields">
    
                                <div class="report_title report_item">    
                                    <div class="report_id">ID</div>
                                    <div class="report_message">{{ __('text.text_240') }}</div>
                                    <div class="report_created">{{ __('text.text_241') }}</div>
                                </div>
                            
                            @foreach ($report as $item)
                                <div class="report_item">    
                                    <div class="report_id">{{ $item->id }}</div>
                                    <div class="report_message">{{ $item->message }}</div>
                                    <div class="report_created">{{ $item->created_at }}</div>
                                </div>
                            @endforeach
                            
                            
                        </div>
                        
                        <?php echo $report->render(); ?>  
                    
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