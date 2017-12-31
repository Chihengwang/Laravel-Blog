<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\http\Model\Article;
use App\Http\Model\Links;
use App\Http\Model\Category;


class IndexController extends HomeDataController
{
    //
    public function index(){
        //點擊最多的六篇文章
        $pics=Article::orderBy('art_view','desc')->take(6)->get();
        // dd($hot);
        //圖文列表
        $data=Article::orderBy('art_time','desc')->paginate(5);
        // dd($data);
        // 最新文章發布8篇
        // dd($new);
        //友情鏈結
        $links=Links::orderBy('link_order','asc')->get();
        // dd($links);
        //配置項讀取


        return view('home.index',compact('pics','data','links'));
    }
    public function cate($cate_id){
        // echo($cate_id);
        //查看次數增加
        Category::where('cate_id',$cate_id)->increment('cate_view');
        $data=Article::where('cate_id',$cate_id)->orderBy('art_time','desc')->paginate(4);
        // dd($data);
        $submenu=Category::where('cate_pid',$cate_id)->get();
        // dd($submenu);
        $field= Category::find($cate_id);
        
        return view('home.list',compact('field','data','submenu'));
    }
    public function article($art_id){

        //查看次數增加
        Article::where('art_id',$art_id)->increment('art_view');

        $field=Article::Join('category','article.cate_id','=','category.cate_id')->where('art_id',$art_id)->first();//取數組沒有collection
        //找出上一篇文章
        $article['pre']=Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        $article['next']=Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
        // dd($article);
        //相關文章抓取
        $data=Article::where('cate_id',$field->cate_id)->orderBy('art_id','desc')->take(6)->get();
        // dd($data);
        return view('home.new',compact('field','article','data'));
    }
}
