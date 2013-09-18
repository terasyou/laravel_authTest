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
	public function getIndex()
	{
		$data['name'] = Auth::user()->name;
		$data['email'] = Auth::user()->email;
		return View::make("user",$data);
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

	//---------------------------------
	//ログイン処理
	//---------------------------------
	public function getLogin(){
		$data["error"] = "";
		return View::make("user/login",$data);
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
			$data["error"] = "メールアドレスかパスワードが間違っています。";
			return  View::make('user/login',$data);
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
	
	//---------------------------------
	//テストページ
	//---------------------------------
	public function getTest(){
		$name = Route::currentRouteAction();
		$name = mb_substr($name, 0, mb_strpos($name,"@"));
		echo $name;
		echo $html = HTML::link('admin/test','管理者ページ');
		return "公開側専用ページになります。";
	}

	//---------------------------------
	//写真のアップロード機能
	//---------------------------------
	public function getFile(){
		$data["file_name"] = "";
		$data["mes"] = "";
		return View::make("user/file",$data);
	}

	public function postFile(){
		$user_name = Auth::user()->name;
		$set_path = public_path('images/'.$user_name.'/');

		// ディレクトリは存在するか確認
		if(!File::exists($set_path))
		{
		    File::makeDirectory($set_path);
		}

		// ファイルは入力されたか
		if(!Input::hasFile('image'))
		{
			$data["file_name"] = "";
		    $data["mes"] = "ファイルがありません";
			return View::make("user/file",$data);
		}
		

		$file = Input::file("image");

		// 情報を取得
		$file_path = $file->getRealPath();
		$name = $file->getClientOriginalName();

		// ファイルをtmpから移動
		File::move($file_path, $set_path.$name);

		// 以降は。。。。

		//ビューに完了メッセージを渡す
		$data["file_name"] = $name;
		$data["mes"] = "アップロードが完了しました。";
		return View::make("user/file",$data);
	}




}


