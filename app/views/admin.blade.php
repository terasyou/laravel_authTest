@extends('layouts.tbs')
@section('header')
<title>管理者ページ</title>
@stop
@section('nav')
@parent
<li>{{ HTML::link('admin/logout','Logout') }}</li>
<li>{{ HTML::link('admin/test','Page') }}</li>
<li>{{ HTML::link('admin/test','Page') }}</li>
@stop
@section('content')

<div class="container hero-unit">
 <h1>Hello World!</h1>
 <h2>ようこそ{{ $name }}さん</h2>
 <p>あなたのメールアドレスは{{ $email }}です。</p>
 
<ul>
	<li>{{ HTML::link('/','サイトのTOP') }}</li>
	<li>{{ HTML::link('admin/logout','ログアウト') }}</li>
</ul>

</div>


<div class="container-fluid">
  <div class="row-fluid">
    <div class="span8">
		<table class="table table-striped table-bordered table-condensed">
			 @foreach($users as $row)
				 <tr>
				 <td>{{ $row->id }}</td>
				 <td>{{ $row->name }}</td>
				 <td>{{ $row->email }}</td>
				 </tr>
			@endforeach	
		</table>
	</div>

	<div class="span4">
		aaaaaaaa
	</div>
	<div class="span4">
		bbbbbbbb
	</div>
	<div class="span4">
		cccccccc
	</div>
</div>
</div>

@stop
@section('footer')
<footer style="background-color:#275073;color:white;text-align:center">
<h4>Terada</h4>
@stop