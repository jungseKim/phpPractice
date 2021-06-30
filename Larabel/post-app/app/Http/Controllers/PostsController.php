<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function create(){
        //뷰 필요
        // dd('ok');오류 띄어줌
        return view('posts.create');
    }
    public function store(Request $request){
                        //서비스 컨테이너에서 주입시켜줌
            // $request->input['title'];
            // $request->input['content'];

            $title=$request->title;
            $content=$request->content;

            dd($request);
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
