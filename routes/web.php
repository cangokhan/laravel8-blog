<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','App\Http\Controllers\Front\Homepage@index')->name('homepage');
Route::get('/blog/{slug}','App\Http\Controllers\Front\Homepage@single')->name('single');





Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
  Route::get('login','App\Http\Controllers\Back\AuthController@login')->name('login');
  Route::post('login','App\Http\Controllers\Back\AuthController@loginPost')->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
  Route::get('panel','App\Http\Controllers\Back\Dashboard@index')->name('dashboard');
  Route::get('logout','App\Http\Controllers\Back\AuthController@logout')->name('logout');
  Route::get('/changeStatus/','App\Http\Controllers\Back\ArticleController@changeStatus')->name('changeStatus');
  Route::get('/deleteArticle/{id}','App\Http\Controllers\Back\ArticleController@delete')->name('deleteArticle');
  Route::resource('articles','App\Http\Controllers\Back\ArticleController');

  Route::get('categories','App\Http\Controllers\Back\CategoryController@index')->name('category.index');
  Route::post('categories/add','App\Http\Controllers\Back\CategoryController@add')->name('category.add');
  Route::get('categories/getData','App\Http\Controllers\Back\CategoryController@getData')->name('category.getData');
  Route::get('/categoryStatusChange/','App\Http\Controllers\Back\CategoryController@changeStatus')->name('categoryStatusChange');

});
