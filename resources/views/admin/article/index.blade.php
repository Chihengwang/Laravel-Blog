@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 文章管理
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<div class="search_wrap">
    </div>
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
        <div class="result_title">
            <h3>全部文章</h3>
        </div>
            <div class="result_content">
            <div class="short_wrap">
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                    <a href="{{url('admin/article/')}}"><i class="fa fa-recycle"></i>全部文章</a>
            </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th>標題</th>
                        <th>點擊次數</th>
                        <th>編輯人</th>
                        <th>發布時間</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">{{$v->art_id}}</td>
                        <td>
                            <a href="#">{{$v->art_title}}</a>
                        </td>
                        <td>{{$v->art_view}}</td>
                        <td>{{$v->art_editor}}</td>
                        <td>{{$v->art_time}}</td>
                        <td>
                            <a href="{{url('admin/article/'.$v->art_id.'/edit')}}">修改</a>
                            <a href="javascript:void(0);" onclick="delArt({{$v->art_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>

                <div class="page_list">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
{{--  可以按F12去找一下 裡面的標籤產生的不一樣 最上面的就是最新的標籤狀況  --}}
<style>
.result_content ul li span {
    font-size: 15px;
    padding: 6px 12px;
}
</style>
<script>
    function delArt(art_id){
        layer.confirm('你確定要刪除這篇文章嗎？', {
        btn: ['確定','不刪除'] //按钮
        }, function(){

        $.post("{{url('admin/article')}}/"+art_id,{'_method':'delete','_token':'{{ csrf_token()}}'},function(data){
            if(data.status==0){
                history.go(0);
                layer.msg(data.msg, {icon: 6});
            }else{
                layer.msg(data.msg, {icon: 5});
            }
        });
        }, function(){
          //layer.msg('也可以这样', {
           // time: 20000, //20s后自动关闭
          //  btn: ['明白了', '知道了']
        //});
        });
    }
</script>
@endsection
