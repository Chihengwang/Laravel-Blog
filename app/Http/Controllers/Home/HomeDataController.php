<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Navs;
use App\http\Model\Article;

class HomeDataController extends Controller
{
    //
    public function __construct(){
        //繼承都會先走這個方法
        // echo '12312312 home data';

        $hot=Article::orderBy('art_view','desc')->take(5)->get();
        $new=Article::orderBy('art_time','desc')->take(8)->get();
        $navs=Navs::orderBy('nav_id','asc')->get();
        // dd($navs);
        
        view()->share('navs', $navs);
        view()->share('new', $new);
        view()->share('hot', $hot);
    }

}
