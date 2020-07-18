<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('top');//name()を追加

// 無料会員登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// ログイン、ログアウト
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');


// 以下管理者用
//ログイン前
Route::group(['prefix' => 'admin'],function(){
    Route::get('login','Admin\LoginController@showLoginForm')->name('admin.showlogin');
    Route::post('login','Admin\LoginController@login')->name('admin.login');
});
//ログイン後
Route::group(['prefix' => 'admin','middleware' => 'auth:admin'],function(){
    Route::get('logout','Admin\LoginController@logout')->name('admin.logout');
});
// データ追加

