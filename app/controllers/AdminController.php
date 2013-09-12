<?php

class AdminController extends BaseController{
	/*
	|----------------------------------------
	| コンストラクター
	|----------------------------------------
	*/
	public function __construct(){
		//authフィルター
		$this->beforeFilter('auth-admin',array('except'=>array('getLogin','postLogin')));
		//,array(
		//フィルター適用の指定
		//'only'=>array('getIndex')));
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
		echo '<li>'.HTML::link('admin/logout','ログアウト').'</li>';
		echo '</ul>';
	}
	/*
	|-----------------------------------
	| 新規作成
	|-----------------------------------
	| 1.GETでビューの表示
	| 2.POSTでユーザー仮登録
	| 3.仮登録後、アクティベートメールの送信
	*/
	//GETの処理
		public function getCreate(){
		return View::make('admin/create');
	}
	//POSTの処理
	public function postCreate(){
		//受信データの整理
		$inputs=Input::only('name','email','password');
		//バリデーションの指定
		$rules=array(
			'name'=>'required',
			'email'=>'required|email|unique:admins',
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
		$admin=Admin::create($inputs);

		return $admin->name.'さん。<br>メールを送信しましたので、アクティベート手続きをして下さい。';
	}

	//---------------------------------
	//ログイン処理
	//---------------------------------

	public function getLogin(){
		return View::make("admin/login");
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

		//ログイン認証
		$inputs['activate']=1;
		if(Auth::attempt($inputs)){
			return Redirect::intended('admin');
		}else{
			return "ログイン出来ませんでした";
		}
	}

	/*
	|-----------------------------------------
	| ログアウト処理
	|-----------------------------------------
	*/
	public function getLogout(){
		Auth::logout();
		return Redirect::to('/');
	}

	public function getTest(){
		echo $html = HTML::link('user/test','公開ページ');
		return "管理側専用ページになります。";
	}
}


