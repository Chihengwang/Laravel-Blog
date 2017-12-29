<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
    //
    //get:admin/config 顯示全部配置項
    public function index(){
        // dd("全部配置項");
        $data=Config::orderBy('conf_order','asc')->get();
        // dd($data[0]);
        foreach ($data as $k => $v) {
            # code...
            switch ($v->field_type) {
                case 'input':
                    # code...
                    // 輸入一個html的標籤
                    $data[$k]->_html='<input type="text" class="lg" name="conf_content[]" value="'.$v->conf_content.'">';
                    // echo($data->_html);
                    break;
                case 'textarea':
                    # code...
                    $data[$k]->_html='<textarea type="text" class="lg" name="conf_content[]">'.$v->conf_content.'</textarea>';
                    // echo $data->_html;
                    break;
                case 'radio':
                    # code...
                    $arr=explode(',',$v->field_value);
                    // print_r($arr);Array ( [0] => 1|開啟 [1] => 0|關閉 )
                    $str='';
                    foreach ($arr as $m => $n) {
                        // echo($n);
                        # code...
                        $c='';
                        $r=explode('|',$n);
                        if($v->conf_content==$r[0]){
                            $c=' checked ';
                        }
                        $str.='<input type="radio" name="conf_content[]"'.$c.' value="'.$r[0].'">'.$r[1].'&nbsp;&nbsp;';

                        //dd($r);array:2 [▼ 0 => "1"1 => "開啟"]
                    }
                    // echo($str);
                    $data[$k]->_html=$str;
                    break;                
                default:
                    # code...
                    break;
            }
        }
        return view('admin.config.index',compact('data'));
    }
    public function changeContent(){
        $input=Input::all();
        // dd($input['conf_id']);
        foreach ($input['conf_id'] as $key => $value) {
            # code...
            Config::where('conf_id',$value)->update(['conf_content'=>$input['conf_content'][$key]]);
        }
        $this->putFile();
        return back()->with('errors','配置項更新成功');
    }

    public function changeOrder(){
        $input=Input::all();
        // $cate_order=request('cate_order');
        $conf=Config::find($input['conf_id']);
        $conf['conf_order']=$input['conf_order'];
        $re=$conf->update();//return 1=succeed 0=fail
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

    //get:admin/config/create/添加配置項
    public function create(){

        return view('admin.config.add');
    }
    //post:admin/config 提交配置項 從add.blade.php引入
    public function store(){
        // $input=Input::all();
        $input=Input::except('_token');
        // dd($input['cate_name']);
        $rules=[
            'conf_name'=> 'required',
            'conf_title'=>'required',
        ];
        //confirmed 用法是為了確定輸入的密碼與確認密碼一樣 記得在pass的板模裡面更改name的名稱為password_confirmation
        $messages=[
            'conf_name.required'=>'名稱不得為空',
            'conf_title.required'=>'標題不得為空',
            
        ];
        //此參數是(name.rules)

        $validator=Validator::make($input, $rules,$messages);
        //三個參數 第一個 規定其輸入的變數，第二其驗證規則，第三其錯誤訊息自訂
        if($validator->passes()){
            // echo 'yes';
            $re=Config::create($input);
            // dd($re); 
            if($re){
                return redirect('admin/config');
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
    //get:admin/config/{config}/edit 編輯配置項
    public function edit($conf_id){
        // dd($conf_id);
        $field=Config::find($conf_id);
        // dd($field);//$field->attr..
        return view('admin.config.edit',compact('field'));
    }

    //put:admin/config/{config}  更新配置項
    public function update($conf_id){
        // dd($input=Input::all());
        $input=Input::except('_token','_method');
        // dd($input);//array
        //update method need to put in the array and column name needs to be the same!
        $re=Config::where('conf_id',$conf_id)->update($input);
        if($re){
            $this->putFile();
            return redirect('admin/config');
        }
        else{
            return back()->with('errors','配置項更新失敗');
        }
    }
    //admin/config/{conf}             | config.destroy 
    public function destroy($conf_id){
        $re=Config::where('conf_id',$conf_id)->delete();
        if($re){
            $this->putFile(); 
            $data=[
                'status'=>0,
                'msg'=>'配置項刪除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'配置項刪除失敗!!'
            ];
        }
        return $data;//response
    }
    public function putFile(){
        //如何取得config文件裏面的資料
        
        // echo \config('web.web_title');
        
        // $config=Config::all();
        $config=Config::pluck('conf_content','conf_name')->all();
        // echo var_export($config,true);
        // dd($config);
        $path=base_path().'\config\web.php';
        //config裡面放的都是array的形式
        $str='<?php return '.var_export($config,true).';';
        //寫入文件 
        file_put_contents($path,$str);
        
    }
    public function show($get){
        // $config=Config::all();
        // echo($get);
        // echo(base_path());
        // dd($config);

    }
}
