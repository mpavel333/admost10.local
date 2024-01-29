<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;


class PagesController extends Controller
{
     public static function getPage($alias){
        
        $Page = DB::table('pages')->where('alias', $alias)->where('published','=', 1)->first();
        if(!$Page) abort(404);
        
        return $Page;
    }

     public static function getPageMetaData($alias){
        
        return DB::table('pages')->where('alias', $alias)->where('published','=', 1)->first();
        //if(!$Page) abort(404);
        
        //return $Page;
    }
    
     
     public function page($alias){
        
        $Page = self::getPage($alias);
        //$Page_images = self::page_images($Page->id);
       
        return view('page', ['Page' => $Page]);
        //return $Page;
    }
}
