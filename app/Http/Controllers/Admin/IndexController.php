<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
class IndexController extends Controller
{
    //
    public function index(){
        return view('admin.index');
    }
    public function info(){
        return view('admin.info');
    }
    public function pass(){
        if($input=Input::all()){
            // dd($input);
            $rules=[
                'password'=> 'required|between:6,20|confirmed',
            ];
            //confirmed 用法是為了確定輸入的密碼與確認密碼一樣 記得在pass的板模裡面更改name的名稱為password_confirmation
            $messages=[
                'password.required'=>'新密碼不得為空',
                'password.between'=>'新密碼需界在6~20個字元',
                'password.confirmed'=>'新密碼與舊密碼需要一樣'
                
            ];
            //此參數是(name.rules)
            $validator=Validator::make($input, $rules,$messages);
            //三個參數 第一個 規定其輸入的變數，第二其驗證規則，第三其錯誤訊息自訂
            if($validator->passes()){
                // echo 'yes';
                $user=User::first();//取用資料庫裡面的資料
                $_password = Crypt::decrypt($user->user_pass);
                if($input['password_o']==$_password){
                    $user->user_pass= Crypt::encrypt($input['password']);
                    $user->update();
                    // return back()->with('yes','修改密碼成功');
                    return view('admin.pass')->with('yes','修改密碼成功');
                }
                else{
                    return back()->with('errors','原密碼錯誤');
                }
                              
            }
            else{
                // dd($validator->errors()->all());
                //取得所有錯誤訊息
                return back()->withErrors($validator);
                //返回錯誤的訊息。用$errors取得
            }
        }
        else{
            return view('admin.pass');
        }
        
    }
}
