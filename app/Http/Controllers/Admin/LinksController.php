<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Links;
use Illuminate\Support\Facades\Input;

class LinksController extends Controller
{
    //
    //get:admin/links 顯示全部分類
    public function index(){

        $data=Links::orderBy('link_order','asc')->get();
        // dd($data);
        return view('admin.links.index',compact('data'));
    }
    public function changeOrder(){
        $input=Input::all();
        // $cate_order=request('cate_order');
        $link=Links::find($input['link_id']);
        $link['link_order']=$input['link_order'];
        $re=$link->update();//return 1=succeed 0=fail
        if($re==1){
            $data=[
                'status'=>0,
                'msg'=>'友情鏈結輸入成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'友情鏈結輸入失敗'
            ]; 
        }
        return $data;
    }
}
