<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Links;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

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

    //get:admin/links/create/添加links
    public function create(){

        return view('admin.links.add');
    }
    //post:admin/links 提交添加分類 從add.blade.php引入
    public function store(){
        // $input=Input::all();
        $input=Input::except('_token');
        // dd($input['cate_name']);
        $rules=[
            'link_name'=> 'required',
            'link_url'=>'required',
        ];
        //confirmed 用法是為了確定輸入的密碼與確認密碼一樣 記得在pass的板模裡面更改name的名稱為password_confirmation
        $messages=[
            'link_name.required'=>'鏈結名稱不得為空',
            'link_url.required'=>'鏈結連結不得為空',
            
        ];
        //此參數是(name.rules)

        $validator=Validator::make($input, $rules,$messages);
        //三個參數 第一個 規定其輸入的變數，第二其驗證規則，第三其錯誤訊息自訂
        if($validator->passes()){
            // echo 'yes';
            $re=Links::create($input);
            // dd($re); 
            if($re){
                return redirect('admin/links');
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
    //get:admin/links/{links}/edit 編輯友情鏈結
    public function edit($link_id){
        // dd($link_id);
        $field=Links::find($link_id);
        // dd($field);
        return view('admin.links.edit',compact('field'));
    }

    //put:admin/links/{links}  更新友情鏈結
    public function update($link_id){
        // dd($input=Input::all());
        $input=Input::except('_token','_method');
        // dd($input);//array
        //update method need to put in the array and column name needs to be the same!
        $re=Links::where('link_id',$link_id)->update($input);
        if($re){
            return redirect('admin/links');
        }
        else{
            return back()->with('errors','友情鏈結更新失敗');
        }
    }
    //admin/links/{link}             | links.destroy 
    public function destroy($link_id){
        $re=Links::where('link_id',$link_id)->delete();
        if($re){
            $data=[
                'status'=>0,
                'msg'=>'友情鏈結刪除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'友情鏈結刪除失敗!!'
            ];
        }
        return $data;//response
    }
}
