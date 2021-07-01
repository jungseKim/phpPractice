<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            //검사
            $request->validate(
                [
                'title'=>'required|min:3',
                'content'=>'required'
                ]
            );

            // dd($request);

            //디비에 저장 하고 

            $post=new Post();
            $post->title=$title;
            $post->content=$content;
            $post->user_id=Auth::user()->id;

            $post->save();

            //결과 뷰를 반환 
           return redirect('/posts/index');
    
            //get 방식요청 view return
            //post 방식은 redirection 

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
        // return view('posts.index');
        
        //orderBy 쓰면 get 해줘야됨
        // $posts=Post::orderBy('created_at','desc')->get();

        // $posts=Post::latest()->get();

        $posts=Post::latest()->paginate(5);

        // dd($posts[0]->created_at);
        return view('posts.index',['posts'=>$posts]);
    }
}
