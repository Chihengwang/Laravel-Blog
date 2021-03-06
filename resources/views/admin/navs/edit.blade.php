@extends('layouts.admin')

@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 自定義導航管理
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>自定義導航修改</h3>
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
                    <a href="{{url('admin/navs/create')}}"><i class="fa fa-plus"></i>添加自定義導航</a>
                    <a href="{{url('admin/navs/')}}"><i class="fa fa-recycle"></i>全部自定義導航</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/navs/'.$field->nav_id)}}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
            <table class="add_tab">
                <tbody>

                    <tr>
                        <th><i class="require">*</i>導航名稱：</th>
                        <td>
                            <input type="text" name="nav_name" value="{{$field->nav_name}}">
                            <input type="text" class="sm" name="nav_alias" value="{{$field->nav_alias}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>導航名稱必須填寫</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>Url：</th>
                        <td>
                            <input type="text" class="lg" name="nav_url" value="{{$field->nav_url}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>排序：</th>
                        <td>
                            <input type="text" class="sm" name="nav_order" value="{{$field->nav_order}}">
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
    
@endsection