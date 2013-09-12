<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

//---------------------------------
//ユーザページ
//---------------------------------
Route::controller("user","UserController");

//---------------------------------
//管理者ページ
//---------------------------------
Route::controller("admin","AdminController");

/*
|---------------------------------------------
| usersテーブルの作成
|---------------------------------------------
*/
Route::get('create/users/table',function(){
 //usersテーブルの存在確認
 if(!Schema::hasTable('users')){
 //usersテーブルの作成
 Schema::create('users',function($table){
 $table->increments('id');
 $table->string('name',32);
 $table->string('email',100);
 $table->string('password',64);
 $table->string('onepass');
 $table->tinyinteger('activate')->default(0);
 $table->integer('role_id')->nullable();
 //$table->integer('group_id')->nullable();
 $table->text('profile')->nullable();
 //created_atとupdated_atの同時作成
 $table->timestamps();
 //deleted_atカラムを追加
 $table->timestamp('deleted_at')->nullable();
 });
 return 'usersテーブルを作成しました。';
 }else{
 return 'usersテーブルが存在しますので、処理を中止します。';
 }
});


/*
|---------------------------------------------
| rolesテーブルの作成
|---------------------------------------------
*/
Route::get('create/roles/table',function(){
//rolesテーブルの存在確認
if(!Schema::hasTable('roles')){
//rolesテーブルの作成
Schema::create('roles',function($table){
$table->increments('id');
$table->string('name',32);
$table->integer('level')->nullable();
//created_atとupdated_atの同時作成
$table->timestamps();
//deleted_atカラムを追加
$table->timestamp('deleted_at')->nullable();
});

//新規Roleの作成
Role::create(array(
'name'=>'Admin',
'level'=>100,
));
Role::create(array(
'name'=>'Manager',
'level'=>70,
));
Role::create(array(
'name'=>'Moderator',
'level'=>50,
));
Role::create(array(
'name'=>'Staff',
'level'=>30,
));
Role::create(array(
'name'=>'User',
'level'=>1,
));
Role::create(array(
'name'=>'Banned',
'level'=>0,
));
}else{
return 'rolesテーブルが存在しますので、処理を中止します。';
}
return 'rolesテーブルを作成しました。';
 
});

/*
|---------------------------------------------
| usersテーブルの作成
|---------------------------------------------
*/
Route::get('create/admins/table',function(){
 //usersテーブルの存在確認
 if(!Schema::hasTable('admins')){
 //usersテーブルの作成
 Schema::create('admins',function($table){
 $table->increments('id');
 $table->string('name',32);
 $table->string('email',100);
 $table->string('password',64);
 $table->string('onepass');
 $table->tinyinteger('activate')->default(0);
 $table->integer('role_id')->nullable();
 //$table->integer('group_id')->nullable();
 $table->text('profile')->nullable();
 //created_atとupdated_atの同時作成
 $table->timestamps();
 //deleted_atカラムを追加
 $table->timestamp('deleted_at')->nullable();
 });
 return 'adminsテーブルを作成しました。';
 }else{
 return 'adminsテーブルが存在しますので、処理を中止します。';
 }
});

Route::get('db',function(){
	//SELECTクエリーを実行する
	$results=DB::select('select * from users');
 	return var_dump($results);
});
