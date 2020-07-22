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
// -----------------ログイン関係なし----------------------------------------------------------
// トップページ
Route::get('/','Admin\CategoryController@index')->name('top');
// カテゴリーの詳細ページへ
Route::get('category/{id}','Admin\CategoryController@show')->name('category.show');
// 品種の詳細ページへ
Route::get('variety/{id}','Admin\VarietyController@show')->name('variety.show');
// 候補の詳細ページへ
Route::get('candidate/{id}','Admin\CandidateController@show')->name('candidate.show');

// -----------------一般ユーザー用----------------------------------------------------------
// 無料会員登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
// ログアウト
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
// 以下ログイン後のみできる操作
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users/{id}'], function () {
        // お気に入り一覧表示
        Route::get('favorites', 'Auth\UsersController@favorites')->name('users.favorites'); 
    });
    Route::group(['prefix' => 'candidate/{id}'], function () {
        Route::post('favorite', 'Auth\FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'Auth\FavoritesController@destroy')->name('favorites.unfavorite');
    });
});

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
    
    // カテゴリー編集ページ表示
    Route::get('category/{id}/edit','Admin\CategoryController@edit')->name('category.edit');
    // 品種編集ページ表示
    Route::get('variety/{id}/edit','Admin\VarietyController@edit')->name('variety.edit');
    // 候補変種ページ表示
    Route::get('candidate/{id}/edit','Admin\CandidateController@edit')->name('candidate.edit');
    
    // カテゴリー編集
    Route::put('category/{id}','Admin\CategoryController@update')->name('category.update');
    // 品種編集
    Route::put('variety/{id}','Admin\VarietyController@update')->name('variety.update');
    // 候補編集
    Route::put('candidate/{id}','Admin\CandidateController@update')->name('candidate.update');
    
    // カテゴリー削除
    Route::delete('category/{id}','Admin\CategoryController@destroy')->name('category.destroy');
    // 品種削除
    Route::delete('variety/{id}','Admin\VarietyController@destroy')->name('variety.destroy');
    // 候補削除
    Route::delete('candidate/{id}','Admin\CandidateController@destroy')->name('candidate.destroy');
});


