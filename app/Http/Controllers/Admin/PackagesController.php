<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\Packages;
use DB;

class PackagesController extends Controller
{
    public function packages(){
        $Packages = DB::table('packages')
                //->orderByDesc('id')
                //->orderBy('ord', 'asc')
                ->paginate(15);
        return view('/admin/packages/index', ['Packages' => $Packages]);
    }
    
    public function add(){
        return view('/admin/packages/add');
    }

    public function submit(Request $request,$id=false){
   
            $new = false;
            
            //$form = $req->all();
            
            //$id = $req->input('id');
            
            $Packages = Packages::find($id);
            
            if(!$Packages): $Packages = new Packages; $new = true; endif;            
                
            
            
            //if(!$id){
           //     $Packages = new packages();
           // }else{
            //    $Packages = packages::find($id);
           // }
           // $Packages->menu_id = $req->input('menu_id');
            
            $Packages->name_ua = $request->input('name_ua');
            $Packages->name_ru = $request->input('name_ru');
            $Packages->name_en = $request->input('name_en');

            $Packages->short_desc_ua = $request->input('short_desc_ua');
            $Packages->short_desc_ru = $request->input('short_desc_ru');
            $Packages->short_desc_en = $request->input('short_desc_en');
            
            
            $Packages->full_desc_ua = $request->input('full_desc_ua');
            $Packages->full_desc_ru = $request->input('full_desc_ru');
            $Packages->full_desc_en = $request->input('full_desc_en');
            
            
            $Packages->price = $request->input('price') ? $request->input('price') : 0;
            //$Packages->price_post = $request->input('price_post') ? $request->input('price_post') : 0;
            
            $Packages->published = $request->input('published') ? 1 : 0;
            
            
            $Packages->popular = $request->input('popular') ? 1 : 0;
            $Packages->free_days = $request->input('free_days') ? $request->input('free_days') : 0;
            $Packages->count_channels_post = $request->input('count_channels_post') ? $request->input('count_channels_post') : 0;
            $Packages->delayed_posting = $request->input('delayed_posting') ? 1 : 0;
            $Packages->buy_and_sell_adv = $request->input('buy_and_sell_adv') ? 1 : 0;
            $Packages->creat_and_part_collections = $request->input('creat_and_part_collections') ? 1 : 0;
            $Packages->withdrawals = $request->input('withdrawals') ? $request->input('withdrawals') : 0;
            $Packages->analytics = $request->input('analytics') ? 1 : 0;
            $Packages->instant_view_blog = $request->input('instant_view_blog') ? 1 : 0;
            $Packages->count_sellers = $request->input('count_sellers') ? $request->input('count_sellers') : 0;
            $Packages->buy_and_sell_channels = $request->input('buy_and_sell_channels') ? 1 : 0;
            
            //$Packages->ord = $req->input('ord');
            
            ////////////
                if($request->input('alias')){
                    $alias = Str::slug($request->input('alias'));
                }else{
                    $alias = Str::slug($request->input('name_ua'));
                }
                
                $Packages->slug = Str::slug($alias);
                
                $count = DB::table('packages')
                ->where('alias', $alias)
                ->where('id', '!=', $id)
                ->count();
                
                if($count>0) $alias .= '-'.($count+1);
                
                $Packages->alias = $alias;
            //////////
            
            
/*          
            $Packages->meta_title_ua = $request->input('meta_title_ua');
            $Packages->meta_title_ru = $request->input('meta_title_ru');
            $Packages->meta_title_en = $request->input('meta_title_en');

            $Packages->meta_description_ua = $request->input('meta_description_ua');
            $Packages->meta_description_ru = $request->input('meta_description_ru');
            $Packages->meta_description_en = $request->input('meta_description_en');

            $Packages->meta_keywords_ua = $request->input('meta_keywords_ua');
            $Packages->meta_keywords_ru = $request->input('meta_keywords_ru');
            $Packages->meta_keywords_en = $request->input('meta_keywords_en');
            
*/            
            //$Packages->custom_fields = json_encode($custom_fields, JSON_UNESCAPED_UNICODE);
            
            
            $Packages->save(); 
            
/*            
            $images = $req->images;
            
            if($images){    
                foreach($images as $image){
                    $sql[] = array(
                      'page_id' => $Packages->id,
                      'image_id' => $image,
                    );
                }
    
                DB::table('packages_images')->insert($sql);
            }            

*/            
            return redirect()->route('admin.packages.edit',$Packages->id);
        
    }
    
     public function edit($id){
        
        $Package = Packages::find($id);
/*
        $Packages_images = DB::table('packages_images')
        ->where('packages_images.page_id', $Packages->id)
        ->join('images', 'images.id', '=', 'packages_images.image_id')
        ->select('images.filename')
        ->get();
        
        if($Packages->alias=='index'){
            $view = 'page_edit_index';
        }else{
            $view = 'page_edit';
        }
*/                
        return view('/admin/packages/edit', ['Package' => $Package]);
        
    }
}
