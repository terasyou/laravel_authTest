<?php

class UserController extends BaseController{
	/*
	|----------------------------------------
	| コンストラクター
	|----------------------------------------
	*/
	public function __construct(){
		//authフィルター
		Config::set('auth.table', 'users');
		$this->beforeFilter('auth',array('except'=>array('getLogin','postLogin')));
		//全POSTにcsrfフィルターの適用
		$this->beforeFilter('csrf',array('on'=>'post'));
	}
	/*
	|------------------------------------
	| TOPページ（authフィルターの適用）
	|------------------------------------
	*/
	public function getIndex(){
		echo 'ようこそ'.Auth::user()->name.'さん<br>';
		echo '<h1>ユーザーのTOPページです。</h1>';
		echo '<ul>';
		echo '<li>'.HTML::link('/','サイトのTOP').'</li>';
		echo '<li>'.HTML::link('user/logout','ログアウト').'</li>';
		echo '</ul>';
		echo $email = Auth::user()->email;
		echo $name = Route::currentRouteName();
	}
	/*
	|-----------------------------------
	| 新規作成
	|-----------------------------------
	*/
	//GETの処理
		public function getCreate(){
		return View::make('user/create');
	}
	//POSTの処理
	public function postCreate(){
		//受信データの整理
		$inputs=Input::only('name','email','password');
		//バリデーションの指定
		$rules=array(
			'name'=>'required',
			'email'=>'required|email|unique:users',
			'password'=>'required|min:4',
		);
		//バリデーションチェック
		$val=Validator::make($inputs,$rules);
		//バリデーションNGなら
		if($val->fails()){
			return Redirect::back()
				->withErrors($val)
				->withInput();
		}

		//ユーザーの新規作成
		$inputs['onepass']=md5(Input::get('name').time());
		$user=User::create($inputs);

		return $user->name.'さん。<br>登録完了です。';
	}


	public function getLogin(){
		$name = Route::currentRouteAction();
		$name = mb_substr($name, 0, mb_strpos($name,"@"));
		echo $name;
		return View::make("user/login");
	}

	public function postLogin(){
		//受信データの整理
		$inputs=Input::only('email','password');
		
		//バリデーションの指定
		$rules=array(
			'email'=>'required|email',
			'password'=>'required|min:4',
		);
		
		//バリデーションチェック
		$val=Validator::make($inputs,$rules);
		
		//バリデーションNGなら
		if($val->fails()){
			return Redirect::back()
			->withErrors($val)
			->withInput();
		}

		if(Auth::attempt($inputs)){
			return Redirect::intended('user');
			//return "ログイン完了！";
		}else{
			return "ログイン出来ませんでした";
		}
	}

	/*
	|-----------------------------------------
	| ログアウト
	|-----------------------------------------
	*/
	public function getLogout(){
		Auth::logout();
		return Redirect::to('/');
	}
	
	public function getTest(){
		$name = Route::currentRouteAction();
		$name = mb_substr($name, 0, mb_strpos($name,"@"));
		echo $name;
		echo $html = HTML::link('admin/test','管理者ページ');
		return "公開側専用ページになります。";
	}
	

}


