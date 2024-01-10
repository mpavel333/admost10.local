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
            
            $files = $request->file('file');
            $ids = [];
            $files_out = [];
            foreach($files as $file){
            
                $fileName = substr(md5(microtime() . rand(0, 9999)), 0, 20).'_'.date('d_m_Y').'.'.$file->getClientOriginalExtension();
                $file->move(public_path($path),$fileName);
                 
                $fileUpload = new Files();
                $fileUpload->filename = $fileName;
                $fileUpload->extension = $file->getClientOriginalExtension();
                $fileUpload->path = $path;
                $fileUpload->save();
                
                $ids[]=$fileUpload->id;
                $files_out[]=$path.'/'.$fileName;
            }
            
            
            return response()->json(['result'=>'success','ids'=>$ids,'files'=>$files_out]);
            
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
