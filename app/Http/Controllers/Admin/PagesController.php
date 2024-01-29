<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pages;
use Illuminate\Support\Str;

use DB;
use File;
use Image;

class PagesController extends Controller
{
    public function pages(){
        $pages = DB::table('pages')
                //->orderByDesc('id')
                //->orderBy('ord', 'asc')
                ->paginate(15);
        return view('/admin/pages/index', ['Pages' => $pages]);
    }
    
    public function add(){
        return view('/admin/pages/add');
    }

    public function submit(Request $request,$id=false){
   
            $new = false;
            
            //$form = $req->all();
            
            //$id = $req->input('id');
            
            $Page = Pages::find($id);
            
            if(!$Page): $Page = new Pages; $new = true; endif;            
                
            
            
            //if(!$id){
           //     $Page = new Pages();
           // }else{
            //    $Page = Pages::find($id);
           // }
           // $Page->menu_id = $req->input('menu_id');
            
            $Page->name_ua = $request->input('name_ua');
            $Page->name_ru = $request->input('name_ru');
            $Page->name_en = $request->input('name_en');
            
            
            $Page->full_desc_ua = $request->input('full_desc_ua');
            $Page->full_desc_ru = $request->input('full_desc_ru');
            $Page->full_desc_en = $request->input('full_desc_en');
            
            
            //echo $request->input('published'); die;
            
            $Page->published = $request->input('published') ? 1 : 0;
            //$Page->ord = $req->input('ord');
            
            ////////////
                if($request->input('alias')){
                    $alias = Str::slug($request->input('alias'));
                }else{
                    $alias = Str::slug($request->input('name_ua'));
                }
                
                $Page->slug = Str::slug($alias);
                
                $count = DB::table('pages')
                ->where('alias', $alias)
                ->where('id', '!=', $id)
                ->count();
                
                if($count>0) $alias .= '-'.($count+1);
                
                $Page->alias = $alias;
            //////////
            
            
            $Page->meta_title_ua = $request->input('meta_title_ua');
            $Page->meta_title_ru = $request->input('meta_title_ru');
            $Page->meta_title_en = $request->input('meta_title_en');

            $Page->meta_description_ua = $request->input('meta_description_ua');
            $Page->meta_description_ru = $request->input('meta_description_ru');
            $Page->meta_description_en = $request->input('meta_description_en');

            $Page->meta_keywords_ua = $request->input('meta_keywords_ua');
            $Page->meta_keywords_ru = $request->input('meta_keywords_ru');
            $Page->meta_keywords_en = $request->input('meta_keywords_en');
            
            
            //$Page->custom_fields = json_encode($custom_fields, JSON_UNESCAPED_UNICODE);
            
            
            $Page->save(); 
            
/*            
            $images = $req->images;
            
            if($images){    
                foreach($images as $image){
                    $sql[] = array(
                      'page_id' => $Page->id,
                      'image_id' => $image,
                    );
                }
    
                DB::table('pages_images')->insert($sql);
            }            

*/            
            return redirect()->route('admin.pages.edit',$Page->id);
        
    }
    
     public function edit($id){
        
        $Page = Pages::find($id);
/*
        $Page_images = DB::table('pages_images')
        ->where('pages_images.page_id', $Page->id)
        ->join('images', 'images.id', '=', 'pages_images.image_id')
        ->select('images.filename')
        ->get();
        
        if($Page->alias=='index'){
            $view = 'page_edit_index';
        }else{
            $view = 'page_edit';
        }
*/                
        return view('/admin/pages/edit', ['Page' => $Page]);
        
    }
   
     
     public function delete($id,$redirect=true)
     {
        
        $Page = Pages::find($id);
        $custom_fields = json_decode($Page->custom_fields, JSON_UNESCAPED_UNICODE);
        
        //print_r($custom_fields); die;
        
        if($custom_fields){
            foreach($custom_fields as $key=>$item){ 
                
                foreach($item as $key2=>$item2){ 

                   $filename = public_path('images/pages/'.$key).'/'.$item2['image'];
                      if(File::exists($filename)) {
                            File::delete($filename);
                      }
                    
                }
                
            }
        }
        
        //die;
        
        $post_images = DB::table('pages_images')
        ->where('pages_images.page_id', $id)
        ->join('images', 'images.id', '=', 'pages_images.image_id')
        ->select('images.filename')
        ->get();

        foreach($post_images as $image){
            DB::table('images')->where('filename', '=', $image->filename)->delete();
            $filename = public_path('images/pages/').'/'.$image->filename;
              if(File::exists($filename)) {
                    File::delete($filename);
              }
            
        }

        DB::table('pages_images')->where('page_id', '=', $id)->delete();
        DB::table('pages')->where('id', $id)->delete();

         if($redirect){
            return redirect()->route('admin_pages');
         }

     }
     
     public function deletes(Request $req)
     {
            if($req->delete){
                foreach($req->delete as $value){
                    $this->delete($value,false);
                }
            }
            
            return redirect()->route('admin_pages');
     }   
}
