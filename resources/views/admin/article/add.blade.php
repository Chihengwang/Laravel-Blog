@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 文章管理
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>添加文章</h3>
           @if(count($errors)>0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
                
            </div>
            @endif
            @isset($yes)
                    <div class="mark">
                        <p>{{$yes}}</p>
                    </div>
            @endisset    
        </div>
        <div class="result_content">
            <div class="short_wrap">
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                    <a href="{{url('admin/article/')}}"><i class="fa fa-recycle"></i>全部文章</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/article')}}" method="post">
        {{ csrf_field() }}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120">分類：</th>
                        <td>
                            <select name="cate_id">
                                <option value="0">==頂級分類==</option>
                                @foreach($data as $d)
                                <option value="{{$d->cate_id}}">{{$d->_cate_name}}</option>    
                                @endforeach
                                
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>文章標題：</th>
                        <td>
                            <input type="text" class="lg" name="art_title">
                            <p>标题可以写50個字</p>
                        </td>
                    </tr>
                    <tr>
                        <th>編輯：</th>
                        <td>
                            <input type="text" class="sm" name="art_editor">
                        </td>
                    </tr>
                    <tr>
                        <th>縮減圖：</th>
                        <td>
                            <input type="text" size="50" name="art_thumb">
                            <input type="file" class="image" accept="image/gif, image/jpeg, image/png">
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <img src="" alt="" id="art_thumb_img" style="max-height: 300px; max-width: 300px">
                        </td>
                    </tr>
                    <tr>
                        <th>關鍵詞：</th>
                        <td>
                            <input type="text" class="lg" name="art_tag">
                        </td>
                    </tr>
                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea name="art_description"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>文章內容：</th>
                        <td>
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.config.js')}}"></script>
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.all.min.js')}}"> </script>
                            <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
                            <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/lang/en/en.js')}}"></script>
                            <script id="editor" type="text/plain" name="art_content" style="width:860px;height:500px;"></script>
                            <script type="text/javascript">
                                var ue = UE.getEditor('editor');
                            </script>
                            <style>
                                .edui-default{line-height:28px;}
                                div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body{overflow: hidden; height:20px;}
                                div.edui-box{overflow: hidden;height: 22px;}
                            </style>
                        </td>
                    </tr>

                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
$(document).ready(function(){
    $("input.image").change(function(){
        //console.log("test");
        //console.log($(this));
        console.log($(this)[0].files[0]);
        var file=$(this)[0].files[0];
        var formdata= new FormData();
        formdata.append("file",file);
        formdata.append("_token","{{ csrf_token()}}");
        console.log(formdata);

          $.ajax({
            type : 'POST',
            url : "{{url('admin/upload')}}",
            data : formdata,
            cache : false, //因為只有上傳檔案，所以不要暫存
            processData : false, //因為只有上傳檔案，所以不要處理表單資訊
            contentType : false, //送過去的內容，由 FormData 產生了，所以設定false
            dataType : 'html'
          }).done(function(data) {

            layer.alert('成功傳送', {icon: 6});
            $('input[name=art_thumb]').val(data);
            $('#art_thumb_img').attr('src','/blog/'+data);
          }).fail(function(data) {

            //失敗的時候
            alert("有錯誤產生，請看 console log");
            console.log(jqXHR.responseText);
          });
    });
});

</script>
@endsection