<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    //get:admin/category 顯示全部分類
    public function index(){
        // $categorys= Category::Tree();
        $categorys=(new Category)->Tree();
        // dd($categorys);
        return view('admin.category.index')->with('data',$categorys);
    }


    public function changeOrder(){
        $input=Input::all();
        // $cate_order=request('cate_order');
        $cate=Category::find($input['cate_id']);
        $cate['cate_order']=$input['cate_order'];
        $re=$cate->update();//return 1=succeed 0=fail
        if($re==1){
            $data=[
                'status'=>0,
                'msg'=>'排序輸入成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'排序輸入失敗'
            ]; 
        }
        return $data;
    }
    //post:admin/category 
    public function store(){

    }
    //get:admin/category/create 創建類別 
    public function create(){
        
    }
    //post:admin/category/{category} 顯示單個分類信息 
    public function show(){
        
    }
    //put:admin/category/{category}  更新分類
    public function update(){
        
    }
    //Delete:admin/category/{category} 刪除單個分類 
    public function destory(){
        
    }
    //get:admin/category/{category}/edit 編輯分類 
    public function edit(){
        
    }
}
