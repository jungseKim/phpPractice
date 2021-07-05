<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class AllControll extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index','show']);
    } 

    public function create(){
        return view('posts/create');
    }
    public function store(Request $request){
        $title=$request->title;
        $content=$request->content;
        // dd($title.$content);

        $post=new Post();
        $post->title=$title;
        $post->content=$content;
        $post->user_id=Auth::user()->id;
        if($request->imageFile){
            $name=$request->imageFile->getClientOriginalName();
            $extention=$request->imageFile->extension();
            $originalName=Str::of($name)->basename('.'.$extention);

            $resultName=$originalName.'_'.time().'.'.$extention;
            // dd($originalName);
           $request->imageFile->storeAs('public/image',$resultName);
           $post->image=$resultName;     
        }

        $post->save();
        
        return redirect('/posts/index');
    }
    
    public function index(){

        $posts=Post::all();
        return view('/posts/index',compact('posts'));
    }
    public function show(Request $request,$id){
        $post=Post::find($id);
        return view('/posts/show',compact('post'));
    }
}
