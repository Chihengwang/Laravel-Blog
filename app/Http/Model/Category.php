<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\Category;

class Category extends Model
{
    //
    protected $table='category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
    protected $guarded = [];

    public function Tree(){
        // $categorys= Category::all();
        $categorys=$this->orderBy('cate_order','asc')->get();
        return $this->getTree($categorys,'cate_name','cate_id','cate_pid');//直接return 給category controller
    }

    public function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid=0){
        //重新排列了新聞的大小關係
        $arr=array();
        foreach ($data as $key => $v) {
            # code...
            // $data[0]['_cate_id']='fuck';
            if($v->$field_pid==$pid){
                $data[$key]['_'.$field_name]=$data[$key][$field_name];
                $arr[]=$data[$key];
                
                foreach ($data as $m => $n) {
                    # code...
                    if($n->$field_pid==$v->$field_id){
                        #上面的判斷就是在於判斷子類別的pid要等於父類別的cate_id
                        $data[$m]['_'.$field_name]='|==='.$data[$m][$field_name];
                        $arr[]=$data[$m];
                    }
                }
            }

        }
        return $arr;
    }
}
