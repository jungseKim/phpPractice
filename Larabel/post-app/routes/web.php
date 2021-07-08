<?php

use App\Http\Controllers\PostsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Route::get('/posts/create',[PostsController::class,'create'])
// ->middleware(['auth']);
//미들웨어 종류가 여러개니까 배열로 보내고
//순서 ->kernel(라우터 미들웨어)->Authenticate->auth.php


Route::get('/posts/create',[PostsController::class,'create']);
Route::get('/posts/myPosts',[PostsController::class,'myPosts'])
->name('posts.myPosts');

Route::post('/posts/store',[PostsController::class,'store']);


Route::get('/posts/index',[PostsController::class,'index'])
->name('posts.index');

         //이렇게 하면 url 파라미터 뒤에 ? 붙으면 쿼리 스트링 
Route::get('/posts/show/{id}',[PostsController::class,'show'])
->name('posts.show');

Route::get('/posts/{id}',[PostsController::class,'edit'])
->name('posts.edit');
Route::put('/posts/{id}',[PostsController::class,'update'])
->name('posts.update');
Route::delete('/posts/{id}',[PostsController::class,'destroy'])
->name('posts.delete');


