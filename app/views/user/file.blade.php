@extends('layouts.tbs')
@section('header')
<title>管理者ページ</title>
@stop
@section('nav')
@parent
@stop
@section('content')
<!DOCTYPE html>
{{ HTML::style('tbs/css/bootstrap.min.css') }}
</head>
<body>

@section('content')
<div class="container hero-unit">

@if($file_name != "")
{{ HTML::image("images/".Auth::user()->name."/".$file_name,"test1", array('width' =>"300",'height' => "300")) }}
@endif
<br>
{{ $mes }}

<h3>ファイルアップロード</h3>
{{ Form::open(array('url' => 'user/file','files' => true)) }}
{{ Form::label('image','写真') }}
{{ Form::file('image') }}<br>
@if($errors->has('image'))
<span style="color:red;">{{ $errors->first('image') }}</span>
@endif
{{ Form::token() }}
{{ Form::submit('アップロード',array('class'=>'btn btn-success')) }}
{{ Form::close() }}

</div>
@stop
</body>
</html>