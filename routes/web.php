<?php

use App\Task;

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


Route::group(['middleware' => 'auth'], function () {

    //ホーム画面へのルーティング
    Route::get('/', 'HomeController@index')->name('home');

    //フォルダの新規作成と表示
    Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    Route::post('/folders/create', 'FolderController@create');


    Route::group(['middleware' => 'can:view,folder'], function () {
        //タスクとフォルダの一覧表示
        Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');
        //タスクの新規作成と表示
        Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
        Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

        //タスクの編集機能
        
        Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
        Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');
    });
    
});

//会員登録機能
Auth::routes();
