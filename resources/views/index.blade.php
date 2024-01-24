<?php
error_reporting(1);
ini_set('display_errors', 1);

require($_SERVER['DOCUMENT_ROOT'].'/main-page/scss/tmplapp.php');
$TmplApp = new TmplApp();
$TmplApp->AutoCompileScss();

# -------- META---------- #
$meta = new stdClass();
# Название сайта
$meta->sitename = 'AdMost';
# Заголовок
$meta->title = 'AdMost — українська біржа реклами в Telegram';
# Описание
$meta->desc = 'Єднаємо рекламодавців та власників телеграм каналів, роблячи їх співпрацю прозорою та ефективною';
# Текущий линк на страницу
$meta->url = './';
# Картинка для соц. сетей, размер: 1200x630px
$meta->image = $meta->url . 'images/social.jpg';

?>
<title><?php echo $meta->title; ?></title>

<base href="<?php echo config('app.url'); ?>" />

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="title" content="<?php echo $meta->title; ?>" />
<meta name="description" content="<?php echo $meta->desc; ?>" />
<link rel="image_src" href="<?php echo $meta->image; ?>" />

<meta property="og:locale" content="ru_RU" />
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php echo $meta->title; ?>" />
<meta property="og:description" content="<?php echo $meta->desc; ?>" />
<meta property="og:image" content="<?php echo $meta->image; ?>" />
<meta property="og:url" content="<?php echo $meta->url; ?>" />
<meta property="og:site_name" content="<?php echo $meta->sitename; ?>" />

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo $meta->title; ?>">
<meta name="twitter:description" content="<?php echo $meta->desc; ?>">
<meta name="twitter:image" content="<?php echo $meta->image; ?>">

<meta itemprop="name" content="<?php echo $meta->title; ?>" />
<meta itemprop="description" content="<?php echo $meta->desc; ?>" />
<meta itemprop="image" content="<?php echo $meta->image; ?>" />



<link rel="stylesheet" href="main-page/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="main-page/plugins/swiper/swiper.min.css">
<link rel="stylesheet" href="main-page/plugins/ion-rangeslider/ion.rangeSlider.min.css">
<link rel="stylesheet" href="main-page/css/style.css?t=<?php echo date('U'); ?>">

<style type="text/css">
    
.dz-preview.dz-image-preview.dz-processing.dz-complete {
  border: 5px solid green;
}

.swiper-wrapper {
    height: auto;
}

</style>


<script src="main-page/plugins/jquery/jquery-3.2.0.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="main-page/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="main-page/plugins/swiper/swiper.min.js"></script>
<script src="main-page/plugins/ion-rangeslider/ion.rangeSlider.min.js"></script>
<script src="main-page/js/my.js?t=<?php echo date('U'); ?>"></script>

</head> 
<body class="transition-off">
    <div class="wrapper">
        <div class="header">
            <div class="container big">
                <div class="row gx-1 align-items-center">
                    <div class="col col-xl-2">
                        <a href="" class="logo">
                            <?php include 'main-page/images/logo.svg'; 
                            //<img src="main-page/images/logo.svg" alt="logo">
                            ?>
                        </a>
                    </div>
                    <div class="col">
                        <div class="main-menu">
                            <div class="close-menu d-lg-none">&times;</div>
                            <nav class="menu">
                                <div class="link">
                                    <a href="">{{ __('text.text_1') }}</a>
                                </div>
                                <div class="link">
                                    <a href="{{route('channels')}}">{{ __('text.text_2') }}</a>
                                </div>
                                <div class="link">
                                    <a href="">{{ __('text.text_3') }}</a>
                                </div>
                                <div class="link">
                                    <a href="">{{ __('text.text_4') }}</a>
                                </div>
                                <div class="link">
                                    <a href="">{{ __('text.text_5') }}</a>
                                </div>
                            </nav>
                            <!-- controls mob -->
                            <div class="control-buttons d-flex column-gap-2 d-md-none">
                                <div class="for-btn w-100">
                                    <a href="/login" class="login cl-btn dark-l-btn w-100">
                                        <div class="icon"> 1111
                                            <?php include 'main-page/images/login.svg'; 
                                                    //<img src="main-page/images/login.svg">
                                            ?>
                                            
                                        </div>
                                        <p>{{ __('text.text_6') }}</p>
                                    </a>
                                </div>
                                <div class="for-btn w-100">
                                    <a href="/registration" class="login cl-btn white-btn w-100">
                                        <div class="icon">
                                            <?php include 'main-page/images/plus.svg'; 
                                            //<img src="main-page/images/plus.svg">
                                            ?>
                                        </div>
                                        <p>{{ __('text.text_7') }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- controls desktop -->
                    <div class="col-auto d-none d-md-block">
                        <div class="control-buttons d-flex column-gap-2">
                            

        <?php if(Auth::guest()){ ?>

                <div class="for-btn">
                    <a href="{{ route('login') }}" class="login cl-btn blue-l-btn">
                        <div class="icon">
                            <?php include 'main-page/images/login.svg'; 
                            //<img src="main-page/images/login.svg">
                            ?>
                            
                        </div>
                        <p>{{ __('text.text_6') }}</p>
                    </a>
                </div>
                <div class="for-btn">
                    <a href="{{ route('register') }}" class="login cl-btn">
                        <div class="icon">
                            <?php include 'main-page/images/plus.svg'; 
                            //<img src="main-page/images/plus.svg">
                            ?>
                        </div>
                        <p>{{ __('text.text_7') }}</p>
                    </a>
                </div>                
        
        <?php }else{ ?>
            
            <?php if(Auth::user()->isAdmin()){ ?>

                <div class="for-btn">
                    <a href="{{ route('admin.index') }}" class="login cl-btn blue-l-btn">
                        <div class="icon">
                            <?php include 'main-page/images/login.svg'; 
                            //<img src="main-page/images/login.svg">
                            ?>
                        </div>
                        <p>{{ __('text.text_8') }}</p>
                    </a>
                </div>
                
            <?php }else{ ?>
                
                <div class="for-btn">
                    <a href="{{ route('user.index') }}" class="login cl-btn blue-l-btn">
                        <div class="icon">
                            <?php include 'main-page/images/login.svg';
                            //<img src="main-page/images/login.svg">
                             ?>
                        </div>
                        <p>{{ __('text.text_9') }}</p>
                    </a>
                </div>
                
            <?php } ?>

                <div class="for-btn">
                    <a href="{{ route('logout') }}" class="login cl-btn blue-l-btn">
                        <div class="icon">
                        <?php include 'main-page/images/login.svg'; 
                            //<img src="main-page/images/login.svg">
                        ?>
                        </div>
                        <p>{{ __('text.text_10') }}</p>
                    </a>
                </div>
        
        <?php } ?>
                            

                            
                            
                        </div>
                    </div>
                    <div class="col-auto d-xl-none">
                        <div class="humb">
                            <div class="dv-1"></div>
                            <div class="dv-2"></div>
                            <div class="dv-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="main">
            <div class="container big">
                <div class="m-inner">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-6">
                            <div class="m-block">
                                <h1 class="title">
                                    <span>
                                        <div class="icon">
                                            <img src="main-page/images/flag.svg" alt="flag">
                                        </div>
                                        AdMost
                                    </span>{{ __('text.text_11') }}
                                </h1>
                                <div class="m-row">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="arrow squad">
                                                <img src="main-page/images/arr-right.svg" alt="arrow">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="text">
                                                <p>{{ __('text.text_12') }}</p>
                                            </div>
                                        </div>
                                        <!-- desktop btn -->
                                        <div class="col-auto d-none d-xl-block">
                                            <div class="for-btn">
                                                <a href="" class="cl-btn big">
                                                    <div class="icon">
                                                        <?php include 'main-page/images/plus.svg'; 
                                                        //<img src="main-page/images/plus.svg">
                                                        ?>
                                                    </div>
                                                    <p>{{ __('text.text_13') }}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="pic">
                                <img src="main-page/images/main-pic.png" alt="pic">
                            </div>
                        </div>
                    </div>
                    <!-- mobile btn -->
                    <div class="for-btn d-xl-none">
                        <a href="" class="cl-btn big">
                            <div class="icon">
                                <?php include 'main-page/images/plus.svg'; 
                                //<img src="main-page/images/plus.svg">
                                ?>
                            </div>
                            <p>{{ __('text.text_13') }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="community">
            <div class="container big">
                <h2 class="title main-title text-center">
                    {!! __('text.text_14') !!}
                </h2>
                <div class="marquee-sliders">
                    <div class="swiper-marquee">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c1.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c2.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c3.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c4.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c5.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c6.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c7.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c8.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c9.jpg" alt="pic">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-marquee" dir="rtl">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c10.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c11.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c12.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c13.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c14.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c15.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c16.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c17.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c18.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c19.jpg" alt="pic">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-marquee">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c20.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c21.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c22.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c23.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c24.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c25.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c26.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c27.jpg" alt="pic">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="pic">
                                    <img src="main-page/images/community/c28.jpg" alt="pic">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="calculator">
                    <div class="for-title text-md-center text-xl-start">
                        <div class="title color-secondary fw-semi">
                            {{ __('text.text_15') }}
                        </div>
                        <p class="mt-3">{!! __('text.text_16') !!}</p>
                    </div>
                    <div class="c-row">
                        <div class="row g-0">
                            <div class="col-12 col-md-7">
                                <div class="c-block cb-1">
                                    <form action="" method="post">
                                        <div class="inputblock">
                                            <p>{{ __('text.text_17') }}</p>
                                            <select name="subject" class="form-select dark-select">
                                                <option value="Авто и мото">Авто и мото</option>
                                                <option value="Хуёто">Хуйото</option>
                                            </select>
                                        </div>
                                        <div class="subscribers-slider">
                                            <div class="i-top">
                                                <p>{{ __('text.text_18') }}</p>
                                                <div class="count"></div>
                                            </div>
                                            <input type="text" class="subscribers-count" name="range" value="" data-type="single" data-min="0" data-max="50000000" data-from="0" data-to="500" data-grid="false" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="c-block cb-2">
                                    <div class="result">
                                        <div class="for-price d-flex align-items-center d-md-block">
                                            <div class="tit me-4 me-md-0 mb-md-3">{!! __('text.text_19') !!}</div>
                                            <div class="price lh-1 text-nowrap">
                                                <span class="fs-xl-48 fs-34 fw-bold me-1 text-nowrap">300 456</span>{{ __('text.text_20') }}
                                            </div>
                                        </div>
                                        <div class="for-btn">
                                            <a href="" class="cl-btn big px-md-4">
                                                <div class="icon">
                                                    <?php include 'main-page/images/plus.svg'; 
                                                    //<img src="main-page/images/plus.svg">
                                                    ?>
                                                </div>
                                                <p>{{ __('text.text_21') }}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="steps">
            <div class="container">
                <div class="for-title">
                    <div class="row">
                        <div class="col-12 col-lg">
                            <h2 class="title main-title text-center text-lg-start">
                                {!! __('text.text_22') !!}
                            </h2>
                        </div>
                        <div class="col-12 col-lg-auto d-none d-lg-block">
                            <div class="icon squad">
                                <img src="main-page/images/arr-d.svg" alt="icon">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step-rows">
                    <div class="s-row">
                        <div class="row">
                            <div class="col-12 col-md col-xl-5">
                                <div class="s-block sb-1">
                                    <div class="number">01</div>
                                    <div class="s-title">
                                        <div class="tit">{{ __('text.text_23') }}</div>
                                        <!-- text mobile -->
                                        <div class="text d-xl-none">
                                            <p>{{ __('text.text_24') }}</p>
                                        </div>
                                        <div class="for-btn">
                                            <a class="cl-btn" href="#">
                                                <div class="icon">
                                                    <?php include 'main-page/images/plus.svg'; 
                                                    //<img src="main-page/images/plus.svg">
                                                    ?>
                                                </div>
                                                <p>{{ __('text.text_25') }}Додати канал</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md col-xl-4 d-none d-xl-block">
                                <div class="s-block sb-2">
                                    <!-- text desktop -->
                                    <div class="text">
                                        <p>{{ __('text.text_24') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-auto col-xl text-xl-center order-first order-md-last">
                                <div class="s-block">
                                    <div class="pic">
                                        <img src="main-page/images/s1.jpg" alt="pic">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="s-row">
                        <div class="row">
                            <div class="col-12 col-md col-xl-5">
                                <div class="s-block sb-1">
                                    <div class="number">02</div>
                                    <div class="s-title">
                                        <div class="tit">{{ __('text.text_26') }}</div>
                                        <!-- text mobile -->
                                        <div class="text d-xl-none">
                                            <p>{{ __('text.text_27') }}</p>
                                        </div>
                                        <div class="for-btn">
                                            <a class="cl-btn" href="#">
                                                <div class="icon">
                                                    <?php include 'main-page/images/plus.svg'; 
                                                    //<img src="main-page/images/plus.svg">
                                                    ?>
                                                </div>
                                                <p>{{ __('text.text_25') }}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md col-xl-4 order-xl-3 d-none d-xl-block">
                                <div class="s-block sb-2">
                                    <!-- text desktop -->
                                    <div class="text">
                                        <p>{{ __('text.text_27') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-auto col-xl-auto text-xl-center order-first order-md-last order-xl-first">
                                <div class="s-block">
                                    <div class="pic">
                                        <img src="main-page/images/s2.jpg" alt="pic">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="s-row">
                        <div class="row">
                            <div class="col-12 col-md col-xl-5">
                                <div class="s-block sb-1">
                                    <div class="number">03</div>
                                    <div class="s-title">
                                        <div class="tit">{{ __('text.text_28') }}</div>
                                        <!-- text mobile -->
                                        <div class="text d-xl-none">
                                            <p>{{ __('text.text_29') }}</p>
                                        </div>
                                        <div class="for-btn">
                                            <a class="cl-btn" href="#">
                                                <div class="icon">
                                                    <?php include 'main-page/images/plus.svg'; 
                                                    //<img src="main-page/images/plus.svg">
                                                    ?>
                                                </div>
                                                <p>{{ __('text.text_25') }}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md col-xl-4 d-none d-xl-block">
                                <div class="s-block sb-2">
                                    <!-- text desktop -->
                                    <div class="text">
                                        <p>{{ __('text.text_29') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-xl text-xl-center order-first order-md-last">
                                <div class="s-block">
                                    <div class="pic">
                                        <img src="main-page/images/s3.jpg" alt="pic">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="why">
            <div class="container">
                <h2 class="title text-center">
                    {!! __('text.text_30') !!}
                </h2>
                <div class="w-row">
                    <div class="row gy-3">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="w-col">
                                <div class="w-block">
                                    <div class="w-top">
                                        <div class="icon">
                                            <img src="main-page/images/w1.svg" alt="icon">
                                        </div>
                                        <div class="tit">{!! __('text.text_31') !!}</div>
                                    </div>
                                    <div class="text">
                                        <p> {{ __('text.text_32') }}</p>
                                    </div>
                                </div>
                                <div class="w-block">
                                    <div class="w-top">
                                        <div class="icon">
                                            <img src="main-page/images/w4.svg" alt="icon">
                                        </div>
                                        <div class="tit">{{ __('text.text_33') }}</div>
                                    </div>
                                    <div class="text">
                                        <p>{{ __('text.text_34') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="w-col">
                                <div class="w-block">
                                    <div class="w-top">
                                        <div class="icon">
                                            <img src="main-page/images/w2.svg" alt="icon">
                                        </div>
                                        <div class="tit">{{ __('text.text_35') }}</div>
                                    </div>
                                    <div class="text">
                                        <p>{{ __('text.text_36') }}</p>
                                    </div>
                                </div>
                                <div class="w-block">
                                    <div class="w-top">
                                        <div class="icon">
                                            <img src="main-page/images/w5.svg" alt="icon">
                                        </div>
                                        <div class="tit">{{ __('text.text_37') }}</div>
                                    </div>
                                    <div class="text">
                                        <p>{{ __('text.text_38') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="w-col flex-md-row flex-lg-column column-gap-md-4 column-gap-lg-0">
                                <div class="w-block">
                                    <div class="w-top">
                                        <div class="icon">
                                            <img src="main-page/images/w3.svg" alt="icon">
                                        </div>
                                        <div class="tit">{{ __('text.text_39') }}</div>
                                    </div>
                                    <div class="text">
                                        <p>{{ __('text.text_40') }}</p>
                                    </div>
                                </div>
                                <div class="w-block">
                                    <div class="w-top">
                                        <div class="icon">
                                            <img src="main-page/images/w6.svg" alt="icon">
                                        </div>
                                        <div class="tit">{{ __('text.text_41') }}</div>
                                    </div>
                                    <div class="text">
                                        <p>{{ __('text.text_42') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-now">
                    <div class="row">
                        <div class="col-12 col-lg-6 text-center">
                            <div class="w-left">
                                <div class="pic">
                                    <img src="main-page/images/thirty.png" alt="pic">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="w-right">
                                <div class="tit fs-xl-28 fs-22 fw-semi">
                                    {!! __('text.text_43') !!}
                                </div>
                                <div class="for-btn mt-4">
                                    <a class="cl-btn big" href="#">
                                        <div class="icon">
                                            <?php include 'main-page/images/plus.svg'; 
                                            //<img src="main-page/images/plus.svg">
                                            ?>
                                        </div>
                                        <p>{{ __('text.text_25') }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="arrow d-none d-md-block">
                        <img src="main-page/images/arr-d-t.svg" alt="arrow">
                    </div>
                </div>
            </div>
        </section>

        <section class="tariffs">
            <div class="container">
                <div class="for-title text-center text-lg-start">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <h2 class="title">
                                {{ __('text.text_44') }}
                            </h2>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="tit fs-xl-28 fs-md-24 fs-20 fw-semi">
                                {!! __('text.text_45') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider">
                    <div class="swiper-packets">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="packet">
                                    <div class="p-top">
                                        <div class="name">{{ __('text.text_46') }}</div>
                                        <p>{{ __('text.text_47') }}</p>
                                    </div>
                                    <div class="p-body">
                                        <div class="for-price">
                                            <div class="price color-main">
                                                <span class="number">199</span>{{ __('text.text_48') }}
                                            </div>
                                            <p class="txt">{{ __('text.text_49') }}</p>
                                        </div>
                                        <div class="arrow-list">
                                            <p><span class="color-main fw-semi">2</span> {{ __('text.text_50') }}</p>
                                            <p>{{ __('text.text_51') }}</p>
                                            <p>{{ __('text.text_52') }}</p>
                                            <p>{{ __('text.text_53') }}</p>
                                            <p>{{ __('text.text_54') }}</p>
                                        </div>
                                    </div>
                                    <div class="p-bottom">
                                        <div class="for-btn">
                                            <a class="cl-btn big" href="#">
                                                {{ __('text.text_55') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="packet packet-dark">
                                    <div class="labe">{{ __('text.text_56') }}</div>
                                    <div class="p-top">
                                        <div class="name">{{ __('text.text_57') }}</div>
                                        <p>{{ __('text.text_58') }}</p>
                                    </div>
                                    <div class="p-body">
                                        <div class="for-price">
                                            <div class="price color-secondary">
                                                <span class="number">269</span>{{ __('text.text_48') }}
                                            </div>
                                            <p class="txt">{{ __('text.text_49') }}</p>
                                        </div>
                                        <div class="arrow-list light">
                                            <p><span class="color-secondary fw-semi">6</span> {{ __('text.text_59') }}</p>
                                            <p>{{ __('text.text_51') }}</p>
                                            <p>{{ __('text.text_52') }}</p>
                                            <p>{{ __('text.text_60') }}</p>
                                            <p>{!! __('text.text_61') !!}</p>
                                        </div>
                                        <div class="plus">
                                            <?php include 'main-page/images/packet-plus.svg'; 
                                            //<img src="main-page/images/packet-plus.svg">
                                            ?>
                                        </div>
                                        <div class="arrow-list light">
                                            <p>{{ __('text.text_62') }}</p>
                                            <p>{{ __('text.text_63') }}</p>
                                            <p>{!! __('text.text_64') !!}</p>
                                            <p>{{ __('text.text_65') }}</p>
                                        </div>
                                    </div>
                                    <div class="p-bottom">
                                        <div class="for-btn">
                                            <a class="cl-btn big" href="#">
                                                {{ __('text.text_66') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="packet packet-light">
                                    <div class="p-top">
                                        <div class="name">{{ __('text.text_67') }}</div>
                                        <p>{!! __('text.text_68') !!}</p>
                                    </div>
                                    <div class="p-body">
                                        <div class="for-price">
                                            <div class="price color-main">
                                                <span class="number">499</span>{{ __('text.text_48') }}
                                            </div>
                                            <p class="txt">{{ __('text.text_49') }}</p>
                                        </div>
                                        <div class="arrow-list">
                                            <span class="fw-semi color-main">6</span> {{ __('text.text_59') }}
                                            {{ __('text.text_51') }}
                                            {{ __('text.text_52') }}
                                            {{ __('text.text_60') }}
                                            {{ __('text.text_69') }}
                                        </div>
                                        <div class="plus">
                                            <?php include 'main-page/images/packet-plus.svg'; 
                                            //<img src="main-page/images/packet-plus.svg">
                                            ?>
                                        </div>
                                        <div class="arrow-list">
                                            <p>{{ __('text.text_62') }}</p>
                                            <p>{{ __('text.text_63') }}</p>
                                            <p>{!! __('text.text_70') !!}
                                            <p>{{ __('text.text_65') }}</p>
                                        </div>
                                    </div>
                                    <div class="p-bottom">
                                        <div class="for-btn">
                                            <a class="cl-btn big" href="#">
                                                {{ __('text.text_66') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button relative-button d-lg-none opacity-50 justify-content-center mt-4">
                        <div class="swiper-button-prev packets-prev"></div>
                        <p class="mx-4">{{ __('text.text_71') }}</p>
                        <div class="swiper-button-next packets-next"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="categories text-center">
            <div class="container big">
                <div class="c-inner">
                    <h2 class="title text-center">
                        {!! __('text.text_72') !!}
                    </h2>
                    <div class="c-row fw-semi">
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c1.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_73') }}</p>
                        </div>
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c2.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_74') }}</p>
                        </div>
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c3.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_75') }}</p>
                        </div>
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c4.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_76') }}</p>
                        </div>
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c5.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_77') }}</p>
                        </div>
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c6.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_78') }}</p>
                        </div>
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c7.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_79') }}</p>
                        </div>
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c8.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_80') }}</p>
                        </div>
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c9.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_81') }}</p>
                        </div>
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c10.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_82') }}</p>
                        </div>
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c11.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_83') }}</p>
                        </div>
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c12.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_84') }}</p>
                        </div>
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c13.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_85') }}</p>
                        </div>
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c14.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_86') }}</p>
                        </div>
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c15.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_87') }}</p>
                        </div>
                        <div class="c-block">
                            <div class="icon squad">
                                <img src="main-page/images/c16.svg" alt="icon">
                            </div>
                            <p>{{ __('text.text_88') }}</p>
                        </div>
                    </div>
                    <div class="for-btn">
                        <a class="cl-btn big" href="#">
                            <div class="icon">
                                <?php include 'main-page/images/plus.svg'; 
                                //<img src="main-page/images/plus.svg">
                                ?>
                            </div>
                            <p>{{ __('text.text_25') }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="brands">
            <div class="container">
                <div class="for-title text-center text-md-start">
                    <div class="row">
                        <div class="col-12 col-md">
                            <h2 class="title">
                                {{ __('text.text_89') }}
                            </h2>
                        </div>
                        <div class="col-12 col-md-auto d-none d-md-block">
                            <div class="swiper-button relative-button">
                                <div class="swiper-button-prev brands-prev"></div>
                                <div class="swiper-button-next brands-next"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider">
                    <div class="swiper-brands">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="brand">
                                    <img src="main-page/images/br1.jpg" alt="brand">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand">
                                    <img src="main-page/images/br2.jpg" alt="brand">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand">
                                    <img src="main-page/images/br3.jpg" alt="brand">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand">
                                    <img src="main-page/images/br4.jpg" alt="brand">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand">
                                    <img src="main-page/images/br5.jpg" alt="brand">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button d-md-none relative-button justify-content-center mt-4">
                        <div class="swiper-button-prev brands-prev"></div>
                        <div class="swiper-button-next brands-next"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ready">
            <div class="container big">
                <div class="r-inner">
                    <div class="row align-items-end">
                        <!-- pic ipad -->
                        <div class="col-12 col-lg-4 text-center order-md-last order-lg-first d-none d-md-block">
                            <div class="w-left">
                                <div class="pic">
                                    <img src="main-page/images/rocket.png" alt="pic">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="w-right ps-xl-4">
                                <h2 class="title fs-xl-28 fs-22 fw-semi">
                                    {!! __('text.text_90') !!}
                                </h2>
                                <!-- pic mobile -->
                                <div class="pic d-md-none">
                                    <img src="main-page/images/rocket.png" alt="pic">
                                </div>
                                <div class="for-btn">
                                    <a class="cl-btn big" href="#">
                                        <div class="icon">
                                            <?php include 'main-page/images/plus.svg'; 
                                            //<img src="main-page/images/plus.svg">
                                            ?>
                                        </div>
                                        <p>{{ __('text.text_91') }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="arrow d-none d-md-block">
                        <img src="main-page/images/arr-d-t.svg" alt="arrow">
                    </div>
                </div>
            </div>
        </section>

        <section class="faq">
            <div class="container">
                <h2 class="title fs-xl-28 fs-22 fw-semi text-center text-md-start">
                    {{ __('text.text_92') }}
                </h2>
                <div class="f-row">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="accordion" id="faq">
                                <div class="card">
                                    <button class="btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f-1">
                                        {{ __('text.text_93') }}
                                    </button>
                                    <div id="f-1" class="collapse" data-bs-parent="#faq">
                                        <div class="card-body">
                                            <p>{!! __('text.text_94') !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <button class="btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f-2">
                                        {{ __('text.text_95') }}
                                    </button>
                                    <div id="f-2" class="collapse" data-bs-parent="#faq">
                                        <div class="card-body">
                                            <p>{!! __('text.text_94') !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <button class="btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f-3">
                                        {{ __('text.text_96') }}
                                    </button>
                                    <div id="f-3" class="collapse" data-bs-parent="#faq">
                                        <div class="card-body">
                                            <p>{!! __('text.text_94') !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <button class="btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f-4">
                                        {{ __('text.text_97') }}
                                    </button>
                                    <div id="f-4" class="collapse" data-bs-parent="#faq">
                                        <div class="card-body">
                                            <p>{!! __('text.text_94') !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <button class="btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f-5">
                                        {{ __('text.text_98') }}
                                    </button>
                                    <div id="f-5" class="collapse" data-bs-parent="#faq">
                                        <div class="card-body">
                                            <p>{!! __('text.text_94') !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="start-now">
                                <div class="tit fs-30 fw-semi">{{ __('text.text_99') }}</div>
                                <div class="pic">
                                    <img src="main-page/images/tg-big.png" alt="pic">
                                </div>
                                <div class="for-btn">
                                    <a class="cl-btn big" href="#">
                                        <div class="icon">
                                            <?php include 'main-page/images/plus.svg'; 
                                            //<img src="main-page/images/plus.svg">
                                            ?>
                                        </div>
                                        <p>{{ __('text.text_25') }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer">
            <div class="container big">
                <div class="f-inner">
                    <div class="row gy-5 gy-lg-0">
                        <div class="col-12 col-sm-6 col-lg-3 order-1">
                            <div class="for-logo text-center text-sm-start">
                                <a href="#" class="logo">
                                    <img src="main-page/images/logo.svg" alt="logo">
                                </a>
                                <p class="fs-14 opacity-50 mt-3 mt-md-4">{!! __('text.text_100') !!}</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 order-3 order-lg-2">
                            <div class="for-links">
                                <div class="tit opacity-50 fw-semi">{{ __('text.text_101') }}</div>
                                <div class="links">
                                    <div class="link">
                                        <a href="">{{ __('text.text_102') }}</a>
                                    </div>
                                    <div class="link">
                                        <a href="">{{ __('text.text_103') }}</a>
                                    </div>
                                    <div class="link">
                                        <a href="">{{ __('text.text_104') }}</a>
                                    </div>
                                    <div class="link">
                                        <a href="">{{ __('text.text_91') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 order-4 order-lg-3">
                            <div class="for-links">
                                <div class="tit opacity-50 fw-semi">{{ __('text.text_105') }}</div>
                                <div class="links">
                                    <div class="link">
                                        <a href="">{{ __('text.text_1') }}</a>
                                    </div>
                                    <div class="link">
                                        <a href="">{{ __('text.text_106') }}</a>
                                    </div>
                                    <div class="link">
                                        <a href="">{{ __('text.text_107') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3 order-2 order-lg-4 text-md-end">
                            <div class="control-buttons d-flex flex-sm-column column-gap-2 row-gap-2">
                                <div class="for-btn">
                                    <a href="/login" class="login cl-btn blue-l-btn">
                                        <div class="icon">
                                            <?php include 'main-page/images/login.svg'; 
                                            //<img src="main-page/images/login.svg">
                                            ?>
                                        </div>
                                        <p class="text-end flex-grow-1">{{ __('text.text_6') }}</p>
                                    </a>
                                </div>
                                <div class="for-btn">
                                    <a href="/registration" class="login cl-btn">
                                        <div class="icon">
                                            <?php include 'main-page/images/plus.svg'; 
                                            //<img src="main-page/images/plus.svg">
                                            ?>
                                        </div>
                                        <p>{{ __('text.text_7') }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>