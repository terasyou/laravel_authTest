<?php

class AdminController extends BaseController{
	/*
	|----------------------------------------
	| コンストラクター
	|----------------------------------------
	*/
	public function __construct(){
		//authフィルター
		Config::set('auth.table', 'admins');
		Config::set('auth.model', 'Admin');
		$this->beforeFilter('admin',array('except'=>array('getLogin','postLogin')));
		//全POSTにcsrfフィルターの適用
		$this->beforeFilter('csrf',array('on'=>'post'));
	}
	/*
	|------------------------------------
	| TOPページ（authフィルターの適用）
	|------------------------------------
	*/
	public function getIndex()
	{
		$data['name'] = Auth::user()->name;
		$data['email'] = Auth::user()->email;
		//ユーザ一覧取得
		$data['users']=User::orderBy('id','desc')->paginate(10);
		return View::make("admin",$data);
	}
	/*
	|-----------------------------------
	| 新規作成
	|-----------------------------------
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
		$data["error"] = "";
		return View::make("admin/login",$data);
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
		//$inputs['activate']=1;
		if(Auth::attempt($inputs)){
			return Redirect::intended('admin');
		}else{
			$data["error"] = "メールアドレスかパスワードが間違っています。";
			return  View::make('admin/login',$data);
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
		$name = Route::currentRouteAction();
		$name = mb_substr($name, 0, mb_strpos($name,"@"));
		echo $name;

		return "管理側専用ページになります。";
	}
}


