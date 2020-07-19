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


// -----------------管理者用----------------------------------------------------------
//ログイン前
Route::group(['prefix' => 'admin'],function(){
    Route::get('login','Admin\LoginController@showLoginForm')->name('admin.showlogin');
    Route::post('login','Admin\LoginController@login')->name('admin.login');
});
//ログイン後
Route::group(['prefix' => 'admin','middleware' => 'auth:admin'],function(){
    Route::get('logout','Admin\LoginController@logout')->name('admin.logout');
    // データ追加ページ一覧表示
    Route::get('index','Admin\CreateController@index')->name('index');
    // カテゴリー追加ページ表示
    Route::get('category','Admin\CategoryController@create')->name('category');
    // 品種追加ページ表示
    Route::get('variety','Admin\VarietyController@create')->name('variety');
    // 候補追加ページ表示
    Route::get('candidate','Admin\CandidateController@create')->name('candidate');
    // 候補写真追加ページ表示
    Route::get('candidatephoto','Admin\CandidatephotoController@create')->name('candidatephoto');
    // 地域追加ページ表示
    Route::get('place','Admin\PlaceController@create')->name('place');
    
    // カテゴリー追加
    Route::post('category','Admin\CategoryController@store')->name('category.store');
    // 品種追加
    Route::post('variety','Admin\VarietyController@store')->name('variety.store');
    // 候補追加
    Route::post('candidate','Admin\CandidateController@store')->name('candidate.store');
    // 候補写真追加
    Route::post('candidatephoso','Admin\CandidatephotoController@store')->name('candidatephoto.store');
    // 地域追加
    Route::post('place','Admin\PlaceController@store')->name('place.store');
});


