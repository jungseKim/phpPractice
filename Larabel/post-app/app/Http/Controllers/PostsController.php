<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function create(){
        //뷰 필요
        return view('posts.create');
    }
    public function store(){
        //뷰 필요
    }
    public function update(){
        return view('posts.update');
    }
    public function edit(){
        //뷰 필요
    }
    public function destory(){
        
    }
    public function show(){
        //뷰 
        return view('posts.show');
    }
    public function index(){
        //뷰 필요
        return view('posts.index');
    }
}
