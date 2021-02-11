<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/timeline' ,[MainController::class, 'showList'])->name("timeline");

Route::get('/post',[PostController::class, 'index'])->name('posts,index');
Route::resource('post',PostController::class,['except' => 'index']);


Route::group(['middleware' => 'auth'], function() { //ログイン状態のみ

    Route::resource('users',UserController::class);

    Route::delete('users/{user}/unfollow', [UserController::class,'unfollow'])->name('unfollow');

});

Route::get('/edit/{id}',[MainController::class, 'edit'])->name('edit');

Route::get('/mylist/{id}',[MainController::class,'myList'])->name('myList');

Route::get('/messagebox/{id}',[MainController::class,'messageBox'])->name('messagebox');

Route::get('/chat/{id}',[MainController::class,'chat'])->name('chat');

Route::get('/searchuser',[MainController::class,'searchUser'])->name('searchUser');

Route::post('/searching',[MainController::class,'searching'])->name('searching');

Route::delete('/searchunfollow/{id}', [MainController::class,'searchUnfollow'])->name('searchUnfollow');

Route::post('/searchfollow',[MainController::class,'searchFollow'])->name('searchFollow');

Route::post('/sendMessage',[MainController::class,'sendMessage'])->name('sendMessage');

Route::post('/reply',[MainController::class,'reply'])->name('reply');

Route::delete('/deleteMessage',[MainController::class,'deleteMessage'])->name('deleteMessage');
