<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<title>ログイン</title>
{{ HTML::style('hbp/hpbparts.css') }}
{{ HTML::style('hpb/container_12Ba_2c_top.css') }}
{{ HTML::style('hpb/main_12Ba_2c.css') }}
{{ HTML::style('hpb/user.css') }}
{{ HTML::style('tbs/css/bootstrap.min.css') }}
</head>
<body>
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
</body>
</html>