<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class FileController extends Controller
{
    //
    public function upload(){
        
        // $input=Input::all();
        //不能用這個方法取全部 我只取出file檔案
        $file=Input::file('file');
        
        if($file->isValid()){
            //上傳檔案之檔案格式.jpg gif...
            
            $extension=$file->getClientOriginalExtension();
            
            //取得在tmp檔案底下絕對路徑 ex:D:\XAMPP2\tmp\phpA550.tmp

            $realPath=$file->getRealPath();

            //確保不重複
            $newName=date('Ymdhis').mt_rand(100,999).'.'.$extension;
            $path=$file->move( base_path() . '/uploads' , $newName);

            $filepath='uploads/'.$newName;
            return $filepath;
        }
    }
}
