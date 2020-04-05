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

Route::get("/", 'HomeController@index')->name('home');

Route::redirect("/home","/");

//Route::get("/register", 'HomeController@register')->name('home');
Auth::routes();

Route::get('/chats', 'ChatController@index');
Route::get('/messages', 'ChatController@fetchAllMessages');
Route::post('/messages', 'ChatController@sendMessage');
Route::get("block_user",function (){
    return view("block.block_user");
});

Route::get("/admin","AdminController@index");
Route::any("add_new_user","AdminController@addNewUser")->name("add_new_user");
Route::any("update_user/{id}","AdminController@updateUser")->name("update_user");
Route::any("delete_user/{id}","AdminController@deleteUser")->name("delete_user");
Route::any("block_user/{id}","AdminController@blockUser")->name("block_user");






