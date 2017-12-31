<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use App\Http\Model\User;
require_once 'resources/org/code/Code.class.php';
class LoginController extends Controller
{
    //
    public function login(){
        // echo("login");
        if($input=Input::all()){
            // dd($input);
            $code=new \Code();
            $_code=$code->get();
            if(\strtoupper($input['code'])!=$_code){
                return back()->with(['msg'=>'驗證碼錯誤']);// Back to last view;
            }
            $user=User::first();
            if($user->user_name!=$input['user_name'] || Crypt::decrypt($user->user_pass)!=$input['user_pass']){
                return back()->with(['msg'=>'帳號或密碼錯誤']);// Back to last view;                
            }
            //Save This as session
            \session(['user'=>$user]);
            // dd(session('user'));
            return \redirect("admin");
        }else{
            
            // var_dump($user);
            // dd($user);
            return view('admin.login');            
        }
    }
    public function code(){
        $code=new \Code();
        $code->make();
    }
    public function quit(){
        \session(['user'=>null]);
        return \redirect("admin/login");
    }

}
