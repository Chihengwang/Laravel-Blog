@extends('layouts.admin')

@section('content')
		<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">後臺管理</div>
			<ul>
				<li><a href="{{url('/')}}" target="_blank" class="active">首頁</a></li>
				<li><a href="{{url('admin/info')}}" target="main">管理頁面</a></li>
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li>管理員：admin</li>
				<li><a href="{{url('admin/pass')}}" target="main">修改密碼</a></li>
				<li><a href="{{url('admin/quit')}}">退出</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>
            <li>
            	<h3><i class="fa fa-fw fa-clipboard"></i>內容管理</h3>
                <ul class="sub_menu">
                    <li><a href="{{url('admin/category/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加分類</a></li>
                    <li><a href="{{url('admin/category/')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>全部分類</a></li>
                    <li><a href="{{url('admin/article/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加文章</a></li>
                    <li><a href="{{url('admin/article/')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>全部文章</a></li>
                </ul>
            </li>
            <li>
            	<h3><i class="fa fa-fw fa-cog"></i>系统设置</h3>
                <ul class="sub_menu" style="display: block;">
					<li><a href="{{url('admin/links/')}}" target="main"><i class="fa fa-fw fa-cubes"></i>友情鏈結</a></li>
                    <li><a href="{{url('admin/navs/')}}" target="main"><i class="fa fa-fw fa-navicon"></i>自定義導航</a></li>
                    <li><a href="{{url('admin/config/')}}" target="main"><i class="fa fa-fw fa-cogs"></i>網站配置調整</a></li>
                </ul>
            </li>
            <li>
            	<h3><i class="fa fa-fw fa-thumb-tack"></i>工具修繕</h3>
                <ul class="sub_menu">
                    <li><a href="http://www.yeahzan.com/fa/facss.html" target="main"><i class="fa fa-fw fa-font"></i>圖片調用</a></li>
                    <li><a href="http://hemin.cn/jq/cheatsheet.html" target="main"><i class="fa fa-fw fa-chain"></i>Jquery doc</a></li>
                    <li><a href="http://tool.c7sky.com/webcolor/" target="main"><i class="fa fa-fw fa-tachometer"></i>配色版</a></li>
                    <li><a href="element.html" target="main"><i class="fa fa-fw fa-tags"></i>其他組件</a></li>
                </ul>
            </li>
        </ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="{{url('admin/info')}}" frameborder="0" width="100%" height="100%" name="main"></iframe> 
		{{-- url可以顯示出localhost/blog/admin/info 去用控制器  --}}
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight © 2017 Create by <a href="#">ChihengWang</a>.
	</div>
	<!--底部 结束-->
@endsection