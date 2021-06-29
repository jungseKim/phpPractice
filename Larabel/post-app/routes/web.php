<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\PostDec;

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

Route::get('/test',function(){
    return 'byby!!';
});

Route::get('/fuck',function(){
    return view('./test/hi');
});

Route::get('/show',function(){
    //로직 처리
    $name='null';
    if(isset($_GET['id'])){
        $name=$_GET['id'];
    }


    return view('test/show',['name'=>$name]);
});

Route:: get('/posts/index',[PostsController::class,'index']);

Route:: get('/posts/create',[PostsController::class,'create']);

Route:: get('/posts/store',[PostsController::class,'store']);

Route:: get('/posts/update',[PostsController::class,'update']);

Route:: get('/posts/edit',[PostsController::class,'edit']);

Route:: get('/posts/show',[PostsController::class,'show']);

Route:: get('/posts/destory',[PostsController::class,'destory']);