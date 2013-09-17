<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,minimum-scale=1">
{{ Html::style('tbs/css/bootstrap.min.css') }}
{{ Html::style('tbs/css/bootstrap-responsive.min.css') }}
@section('header')
<title>Laravel4</title>
@show
</head>
<body>
<div class="navbar">
<div class="navbar-inner">
<div class="ccontainer">
{{ Html::link('#','Laravel4',array('class'=>'brand')) }}
<ul class="nav">
@section('nav')
<li><a href='#'>TOP</a></li>
@show
</ul>
</div>
</div>
</div>
@yield('content')
@section('footer')
<footer style="background-color:green;color:white;text-align:center">
</footer>
@show
{{ Html::script('http://code.jquery.com/jquery-1.9.1.min.js') }}
{{ Html::script('tbs/js/bootstrap.min.js') }}
</body>
</html>