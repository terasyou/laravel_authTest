@extends('layouts.tbs')
@section('header')
<title>管理者ページ</title>
@stop
@section('nav')
@parent
@stop
<!DOCTYPE html>
{{ HTML::style('tbs/css/bootstrap.min.css') }}
</head>
<body>

@section('content')
<div class="container hero-unit">



    <h1>Laravel4 meets TwitterBootstrap</h1>
    <h2>Arrive has gone</h2>

    <ul>
        <li>{{ HTML::link('user','公開サイト') }}</li>
        <li>{{ HTML::link('admin','管理サイト') }}</li>
    </ul>
</div>
	{{ HTML::image('img/icon.png',"test1", array('width' =>"300",'height' => "145")) }}
	{{ HTML::image('img/laravel4.png',"test1", array('width' =>"120",'height' => "120")) }}

@stop
</body>
</html>
