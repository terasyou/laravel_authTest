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

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
    	{{ HTML::image('img/1.jpg',"test1") }}
      <h2>span4</h2>
      <p>画面上を16カラムで分割されていて、そこをどう使うかでレイアウトしていく感じ。
		ちょっと使った感じ開発の時にはかなり使いやすい！！
		ただDOMを書く量のが少し増える。その辺は snipets で対応できる範囲な気がしてる。
		作ればそのうち公開する予定。そもそも作るかどうかもあるけど(ぉ
		ぱっと見た感じはどうしても twitter っぽくはなるのは諦めるしかないｗ</p>
    </div>
	<div class="span4">
		{{ HTML::image('img/2.jpg',"test1") }}
      <h2>span4</h2>
      <p>画面上を16カラムで分割されていて、そこをどう使うかでレイアウトしていく感じ。
		ちょっと使った感じ開発の時にはかなり使いやすい！！
		ただDOMを書く量のが少し増える。その辺は snipets で対応できる範囲な気がしてる。
		作ればそのうち公開する予定。そもそも作るかどうかもあるけど(ぉ
		ぱっと見た感じはどうしても twitter っぽくはなるのは諦めるしかないｗ</p>
    </div>

    <div class="span4">
   	  {{ HTML::image('img/3.jpg',"test1") }}
      <h2>span4</h2>
      <p>画面上を16カラムで分割されていて、そこをどう使うかでレイアウトしていく感じ。
		ちょっと使った感じ開発の時にはかなり使いやすい！！
		ただDOMを書く量のが少し増える。その辺は snipets で対応できる範囲な気がしてる。
		作ればそのうち公開する予定。そもそも作るかどうかもあるけど(ぉ
		ぱっと見た感じはどうしても twitter っぽくはなるのは諦めるしかないｗ</p>
    </div>

  </div>
</div>

@stop
@section('footer')
<footer style="background-color:#275073;color:white;text-align:center">
<h4>terada</h4>
@stop