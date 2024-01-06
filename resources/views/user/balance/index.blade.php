<html>

<head>

    @include('user.inc.head')

</head>

<body class="control-panel transition-off">
    <div class="wrapper">
        
        @include('user.inc.mobile-menu')
        <?php /*MOBILE MENU*/ //include 'mobile-menu.php'; ?>

        <div class="panel-inner">
            
            @include('user.inc.panel-header')
            <?php /*PANEL HEADER*/ //include 'panel-header.php'; ?>

            <div class="panel-body d-block d-xl-flex">
                
                @include('user.inc.main-menu')
                <?php /*MAIN MENU*/ //include 'main-menu.php'; ?>

                <div class="panel-main channel-new white-block">
                    <h1 class="title gap-title d-flex align-items-center">
                        <p>Пополнение баланса</p>
                    </h1>
                    
                    
                    @include('user.inc.alerts')                    
                    
                    
                    <div class="channel-fields">
                        <form action="{{ route('user.balance.add.submit') }}" method="post">
                            @csrf
                            <div class="f-row">
                                <div class="info-column basic-info p-0">
                                    <div class="text-block">
                                        <div class="tit">Введите сумму</div>
                                        <div class="inputblock">
                                            <input name="amount" type="text" placeholder="10000" class="form-control" onkeypress='validate(event)' required>
                                            <p class="info">укажите сумму пополнения</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="for-btn text-center add-btn-wrapper">
                                <button type="submit" class="cl-btn big">
                                    <p>Пополнить</p>
                                    <div class="icon ms-2">
                                        <?php include 'lc-styles/images/arr-top-right.svg'; ?>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel-banner white-block min-banner">

                </div>                  
                

            </div>
        </div>
    </div>

    <!-- Format template -->
    <template class="format-template">
        <div class="inputblock clone-block format-block removable" data-currency="грн">
            <div class="check"></div>
            <div class="delete-icon-main"></div>
            <input class="clone-input format-input" name="format[]" placeholder="Свій формат" type="text">
            <div class="divider"></div>
            <input class="clone-input price-input" name="price[]" placeholder="Вкажіть ціну" type="text" onkeypress='validate(event)'>
        </div>
    </template>

    <!-- all plugins -->
    @include('user.inc.scripts')
    <?php //include 'scripts.php'; ?>

</body>

</html>