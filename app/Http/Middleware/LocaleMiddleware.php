<?php

namespace App\Http\Middleware;

use Closure;
//use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Request;
use App;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  //  public function handle(Request $request, Closure $next): Response
  //  {
  //      return $next($request);
  //  }
  
  
    public static $mainLanguage = 'ua'; //основной язык, который не должен отображаться в URl
    
    public static $languages = ['ua', 'ru', 'en']; // Указываем, какие языки будем использовать в приложении. 

    
    /*
     * Проверяет наличие корректной метки языка в текущем URL
     * Возвращает метку или значеие null, если нет метки
     */
    public static function getLocale()
    {
        $uri = Request::path(); //получаем URI 
    
    
        $segmentsURI = explode('/',$uri); //делим на части по разделителю "/"
    
    
        //Проверяем метку языка  - есть ли она среди доступных языков
        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {
    
            if ($segmentsURI[0] != self::$mainLanguage) return $segmentsURI[0]; 
    
        }
        return null; 
    }

    /*
    * Устанавливает язык приложения в зависимости от метки языка из URL
    */
    public function handle($request, Closure $next)
    {
        $locale = self::getLocale();

        if($locale) App::setLocale($locale); 
        //если метки нет - устанавливаем основной язык $mainLanguage
        else App::setLocale(self::$mainLanguage); 

        return $next($request); //пропускаем дальше - передаем в следующий посредник
    }
    


}
