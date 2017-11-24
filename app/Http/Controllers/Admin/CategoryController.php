<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Category;

class CategoryController extends Controller
{
    //get:admin/category 顯示全部分類
    public function index(){
        $categorys= Category::all();
        return view('admin.category.index')->with('data',$categorys);
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
