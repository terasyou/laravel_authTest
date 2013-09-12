@extends('layouts.base')
@section('content')
<h2>ユーザー新規作成</h2>
{{ Form::open() }}
{{ Form::label('name','氏名') }}
{{ Form::text('name',Input::old('name','')) }}
@if($errors->has('name'))
<h3 style="color:red;text-align:center">{{ $errors->first('name') }}</h3>
@endif
{{ Form::label('email','メール') }}
{{ Form::text('email',Input::old('email','')) }}<br>
@if($errors->has('email'))
<h3 style="color:red;text-align:center">{{ $errors->first('email') }}</h3>
@endif
{{ Form::label('password','パスワード') }}
{{ Form::password('password') }}<br>
@if($errors->has('password'))
<h3 style="color:red;text-align:center">{{ $errors->first('password') }}</h3>
@endif
{{-- Form::token() --}}
{{ Form::submit('新規作成',array('class'=>'btn btn-success')) }}
{{ Form::close() }}
@stop