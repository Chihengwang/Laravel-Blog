<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;
use App\http\Model\Article;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    //
    //get:admin/article 顯示全部分類
    public function index(){
        return view('admin.article.index');
    }
//================================================
//到添加文章的頁面   route admin/article/create
    public function create(){
        // echo "add article";
        // dd((new Category)->Tree());
        $data=(new Category)->Tree();
        return view('admin.article.add',compact('data'));
    }
//================================================
//  route post admin/article
    public function store(){
        $input=Input::except('_token');
        $input['art_time']=time();
        $rules=[
            'art_title'=> 'required',
            'art_content'=> 'required',
        ];
        //confirmed 用法是為了確定輸入的密碼與確認密碼一樣 記得在pass的板模裡面更改name的名稱為password_confirmation
        $messages=[
            'art_title.required'=>'文章標題不得為空',
            'art_content.required'=>'文章內容不得為空',
            
        ];
        //此參數是(name.rules)
        $validator=Validator::make($input, $rules,$messages);
        
        //三個參數 第一個 規定其輸入的變數，第二其驗證規則，第三其錯誤訊息自訂
        if($validator->passes()){
            // echo 'yes';
            $re= Article::create($input);
            if($re){
                return redirect('admin/article');
            }else{
                return back()->with('errors','資料填寫錯誤');
            }         
        }
        else{
            // dd($validator->errors()->all());
            //取得所有錯誤訊息
            return back()->withErrors($validator);
            //返回錯誤的訊息。用$errors取得
        }
    }
}
