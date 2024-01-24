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
  
  
    public static $mainLanguage = 'ua'; //�������� ����, ������� �� ������ ������������ � URl
    
    public static $languages = ['ua', 'ru', 'en']; // ���������, ����� ����� ����� ������������ � ����������. 

    
    /*
     * ��������� ������� ���������� ����� ����� � ������� URL
     * ���������� ����� ��� ������� null, ���� ��� �����
     */
    public static function getLocale()
    {
        $uri = Request::path(); //�������� URI 
    
    
        $segmentsURI = explode('/',$uri); //����� �� ����� �� ����������� "/"
    
    
        //��������� ����� �����  - ���� �� ��� ����� ��������� ������
        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {
    
            if ($segmentsURI[0] != self::$mainLanguage) return $segmentsURI[0]; 
    
        }
        return null; 
    }

    /*
    * ������������� ���� ���������� � ����������� �� ����� ����� �� URL
    */
    public function handle($request, Closure $next)
    {
        $locale = self::getLocale();

        if($locale) App::setLocale($locale); 
        //���� ����� ��� - ������������� �������� ���� $mainLanguage
        else App::setLocale(self::$mainLanguage); 

        return $next($request); //���������� ������ - �������� � ��������� ���������
    }
    


}
