<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //이렇게 하면 이안에 있는 모든 메소드에 다적용
    public function __construct()
    {                                  //예외
        $this->middleware(['auth'])->except(['index','show']);
    }

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
            //리다이렉션 안했을때 뷰는 이거고 링크는 store그대로임 
            // return view('/post/index');

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
    //쿼리 스트링 하고 url 구분하기
    public function show(Request $request,$id){
        //파라미터로 받을때 항상 리퀘스트 객체가 먼저있어야됨
        
        // dd($request->page);
        $page=$request->page;
        $post=Post::find($id);
        // $user_name=User::find($id);
    
        return view('posts.show',compact('post','page'));
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
