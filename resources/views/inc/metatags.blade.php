<?php

# -------- META---------- #
$meta = new stdClass();
# Название сайта
$meta->sitename = 'AdMost';

 //print_r($Page);

if(isset($Page)){
    
    $Page = (array) $Page;
    
    $lang = App\Http\Middleware\LocaleMiddleware::getLocale();
    if(empty($lang)) $lang = 'ua';
   
    # Заголовок
    $meta->title = $Page['meta_title_'.$lang];
    # Описание
    $meta->desc = $Page['meta_description_'.$lang];
    # Текущий линк на страницу
    $meta->url = './';
    # Картинка для соц. сетей, размер: 1200x630px
    $meta->image = $meta->url . 'images/social.jpg';

}else{

    # Заголовок
    $meta->title = 'AdMost — українська біржа реклами в Telegram';
    # Описание
    $meta->desc = 'Єднаємо рекламодавців та власників телеграм каналів, роблячи їх співпрацю прозорою та ефективною';
    # Текущий линк на страницу
    $meta->url = './';
    # Картинка для соц. сетей, размер: 1200x630px
    $meta->image = $meta->url . 'images/social.jpg';
    
    
}


?>
<title><?php echo $meta->title; ?></title>

<base href="<?php echo config('app.url'); ?>" />

<meta name="csrf-token" content="{{ csrf_token() }}">

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
