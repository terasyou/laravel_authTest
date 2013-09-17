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

{{ $error }}

<h3>ログイン</h3>
{{ Form::open() }}
{{ Form::label('email','メール') }}
{{ Form::text('email',Input::old('email','')) }}<br>
@if($errors->has('email'))
<h4 style="color:red;text-align:center">{{ $errors->first('email') }}</h4>
@endif
{{ Form::label('password','パスワード') }}
{{ Form::password('password') }}<br>
@if($errors->has('password'))
<h4 style="color:red;text-align:center">{{ $errors->first('password') }}</h4>
@endif
{{ Form::token() }}
{{ Form::submit('ログイン',array('class'=>'btn btn-success')) }}
{{ Form::close() }}

</div>
@stop
</body>
</html>