<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Files;

use Image;
use File;
use DB;

class DropzoneController extends Controller
{

        public function add(Request $request,$folder='test')
        {

            $path = 'uploads/'.date('Y').'/'.date('m').'/'.date('d');
            if(!is_dir($path)) mkdir($path,true,755);
            
            $images = $request->file('file');
            $ids = [];
            foreach($images as $image){
            
                $imageName = substr(md5(microtime() . rand(0, 9999)), 0, 20).'_'.date('d_m_Y').'.'.$image->getClientOriginalExtension();
                $image->move(public_path($path),$imageName);
                 
                $imageUpload = new Files();
                $imageUpload->filename = $imageName;
                $imageUpload->extension = $image->getClientOriginalExtension();
                $imageUpload->path = $path;
                $imageUpload->save();
                
                $ids[]=$imageUpload->id;
            }
            
            
            return response()->json(['result'=>'success','ids'=>$ids]);
            
        }

        public function delete(Request $request)
        {
            
            $result_message = '';
            
            $File = Files::find($request->input('id'));
            
            if($File){
                DB::delete('delete from files where id = ?',[$File->id]);
                if(File::exists($File->path.'/'.$File->filename)) {
                    File::delete($File->path.'/'.$File->filename);
                    $result_message = 'file delete';
                }
            }else{
                $result_message = 'file not found';
            }
            
            return response()->json(['id'=>$request->input('id'),'message'=>$result_message]);
            
        
        } 
}
