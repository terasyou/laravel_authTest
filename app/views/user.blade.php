@extends('layouts.tbs')
@section('header')
<title>Laravel初心者講座</title>
@stop
@section('nav')
@parent
<li>{{ HTML::link('user/logout','Logout') }}</li>
<li>{{ HTML::link('user/test','Page') }}</li>
<li>{{ HTML::link('user/test','Page') }}</li>
@stop
@section('content')
<div class="container hero-unit">
 <h1>Hello World!</h1>
 <h2>ようこそ{{ $name }}さん</h2>
 <p>あなたのメールアドレスは{{ $email }}です。</p>
 
<ul>
	<li>{{ HTML::link('/','サイトのTOP') }}</li>
	<li>{{ HTML::link('user/logout','ログアウト') }}</li>
</ul>

</div>
@stop
@section('footer')
<footer style="background-color:#275073;color:white;text-align:center">
<h4>terada</h4>
@stop