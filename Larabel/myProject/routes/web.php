<?php

use App\Http\Controllers\AllControll;
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

Route::get('posts/create',[AllControll::class,'create']);

Route::get('posts/myIndex',[AllControll::class,'myIndex'])
->name('posts.myIndex');

Route::post('/posts/store',[AllControll::class,'store']);

Route::get('posts/index',[AllControll::class,'index'])
->name('posts.index');

Route::get('posts/show/{id}',[AllControll::class,'show'])
->name('posts.show');

Route::get('/posts/search',[AllControll::class,'search'])
->name('posts.search');
//posts.search
Route::post('posts/comment',[AllControll::class,'comment'])
->name('posts.comment');

Route::put('posts/{id}',[AllControll::class,'update'])
->name('posts.update');

Route::get('posts/{id}',[AllControll::class,'edit'])
->name('posts.edit');

Route::put('posts/Recommendation/{id}',[AllControll::class,'Recommendation'])
->name('posts.Recommendation');

Route::delete('posts.delete/{id}',[AllControll::class,'delete'])
->name('posts.delete');

Route::get('posts/userinfo/{id}',[AllControll::class,'userinfo'])
->name('posts.userinfo');