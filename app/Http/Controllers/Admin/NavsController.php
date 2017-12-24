<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\navs;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends Controller
{
    //
    //get:admin/navs 顯示全部自定義導航
    public function index(){

        $data=Navs::orderBy('nav_order','asc')->get();
        // dd($data);
        return view('admin.navs.index',compact('data'));
    }
    public function changeOrder(){
        $input=Input::all();
        // $cate_order=request('cate_order');
        $nav=Navs::find($input['nav_id']);
        $nav['nav_order']=$input['nav_order'];
        $re=$nav->update();//return 1=succeed 0=fail
        if($re==1){
            $data=[
                'status'=>0,
                'msg'=>'導航排序輸入成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'導航排序輸入失敗'
            ]; 
        }
        return $data;
    }

    //get:admin/navs/create/添加自定義導航
    public function create(){

        return view('admin.navs.add');
    }
    //post:admin/navs 提交自定義導航 從add.blade.php引入
    public function store(){
        // $input=Input::all();
        $input=Input::except('_token');
        // dd($input['cate_name']);
        $rules=[
            'nav_name'=> 'required',
            'nav_url'=>'required',
        ];
        //confirmed 用法是為了確定輸入的密碼與確認密碼一樣 記得在pass的板模裡面更改name的名稱為password_confirmation
        $messages=[
            'nav_name.required'=>'導航名稱不得為空',
            'nav_url.required'=>'導航連結不得為空',
            
        ];
        //此參數是(name.rules)

        $validator=Validator::make($input, $rules,$messages);
        //三個參數 第一個 規定其輸入的變數，第二其驗證規則，第三其錯誤訊息自訂
        if($validator->passes()){
            // echo 'yes';
            $re=Navs::create($input);
            // dd($re); 
            if($re){
                return redirect('admin/navs');
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
    //get:admin/navs/{navs}/edit 編輯自定義導航
    public function edit($nav_id){
        // dd($nav_id);
        $field=Navs::find($nav_id);
        // dd($field);
        return view('admin.navs.edit',compact('field'));
    }

    //put:admin/navs/{navs}  更新自定義導航
    public function update($nav_id){
        // dd($input=Input::all());
        $input=Input::except('_token','_method');
        // dd($input);//array
        //update method need to put in the array and column name needs to be the same!
        $re=Navs::where('nav_id',$nav_id)->update($input);
        if($re){
            return redirect('admin/navs');
        }
        else{
            return back()->with('errors','自定義導航更新失敗');
        }
    }
    //admin/navs/{nav}             | navs.destroy 
    public function destroy($nav_id){
        $re=Navs::where('nav_id',$nav_id)->delete();
        if($re){
            $data=[
                'status'=>0,
                'msg'=>'自定義導航刪除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'自定義導航刪除失敗!!'
            ];
        }
        return $data;//response
    }
    public function show(){

    }
}
