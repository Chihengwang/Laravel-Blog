<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


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
    //post:admin/category 提交添加分類 從add.blade.php引入
    public function store(){
        // $input=Input::all();
        $input=Input::except('_token');
        // dd($input);
        $rules=[
            'cate_name'=> 'required',
        ];
        //confirmed 用法是為了確定輸入的密碼與確認密碼一樣 記得在pass的板模裡面更改name的名稱為password_confirmation
        $messages=[
            'cate_name.required'=>'標題名稱不得為空',
            
        ];
        //此參數是(name.rules)

        $validator=Validator::make($input, $rules,$messages);
        //三個參數 第一個 規定其輸入的變數，第二其驗證規則，第三其錯誤訊息自訂
        if($validator->passes()){
            // echo 'yes';
            $re=Category::create($input);
            // dd($re); 
            if($re){
                return redirect('admin/category');
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
    //get:admin/category/create 添加類別 
    public function create(){
        $data= Category::where('cate_pid',0)->get();
        return view('admin.category.add',compact('data'));
    }

    //get:admin/category/{category}/edit 編輯分類 
    public function edit($cate_id){
        $field= Category::find($cate_id);
        $data= Category::where('cate_pid',0)->get();
        // dd($field); model
        return view('admin.category.edit',compact(['field','data']));
    }
    
    //put:admin/category/{category}  更新分類
    public function update($cate_id){
        $input=Input::except('_token','_method');
        // print_r($input);//array
        //update method need to put in the array and column name needs to be the same!
        $re=Category::where('cate_id',$cate_id)->update($input);
        if($re){
            return redirect('admin/category');
        }
        else{
            return back()->with('errors','分類更新失敗');
        }
    }
    //post:admin/category/{category} 顯示單個分類信息 
    public function show(){
        
    }

    //Delete:admin/category/{category} 刪除單個分類 
    public function destory(){
        
    }

}
