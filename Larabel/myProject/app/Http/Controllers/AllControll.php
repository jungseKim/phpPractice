<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $request->validate(
            [
                'title'=>'required|min:3',
                'content'=>'required',
                'image'=>'image|max:2000'
            ]
            );


        $post=new Post();
        $post->title=$title;
        $post->content=$content;
        $post->user_id=Auth::user()->id;
        if($request->imageFile){
            $post->image=$this->PathFind($request);
        }

        $post->save();
        
        return redirect('/posts/index');
    }
    
    public function index(){

        $posts=Post::latest()->paginate(5);
     
        $users=User::all();
        
        return view('/posts/index',compact('posts','users'));
    
    }
    public function show(Request $request,$id){
        $page=$request->page;
        $post=Post::find($id);
        $nickName=User::find($post->user_id)->name;
        $where=$request->where;
        return view('/posts/show',compact(['page','post','nickName','where']));
    }

    public function edit(Request $request,$id){
        $post=Post::find($id);
        $page=$request->page;

        if($request->user()->cannot('update',$post)){
            abort(403);
        }
        $where=$request->where;
        return view('posts.edit',compact('post','page','where'));
    }
    public function update(Request $request,$id){
        $post=Post::find($id);

        $request->validate(
            [
                'title'=>'required|min:3',
                'content'=>'required',
                'imageFile'=>'image|max:2000'
                ]
            );
        if($request->file('imageFile')){
            $imagePath='public/image/'.$post->image;
            Storage::delete($imagePath);
            $post->image=$this->PathFind($request);
        }

        $post->title=$request->title;
        $post->content=$request->content;
        $post->save();
        $page=$request->page;

        if($request->user()->cannot('update',$post)){
            abort(403);
        }
        $where=$request->where;
        
        return redirect()->route('posts.show',['id'=>$id,'page'=>$page,'where'=>$where]);
        
    }  

    public function delete(Request $request,$id){
        $post=Post::find($id);
        if($post->image){
        Storage::delete('public/image/'.$post->image);
        }
        $post->delete();
        $page=$request->page;

        if($request->user()->cannot('delete',$post)){
            abort(403);
        }

        if($request->where=='my'){
            return redirect()->route('posts.myIndex',compact('page'));      
        }
          return redirect()->route('posts.index',compact('page'));
    }

    public function userinfo(Request $request,$id){
        $user=User::find($id);
        $posts=Post::all();
        $page=$request->page;
        return view('posts.userInfo',compact('user','posts','page'));
    }

    public function myIndex(){
        $posts=auth()->user()->posts()->latest()->paginate(5);
        // dd($posts);
        return view('posts.myIndex',['posts'=>$posts]);
    }
    public function comment(){
        
    }

    public function PathFind(Request $request){
        $name=$request->imageFile->getClientOriginalName();
        $extention=$request->imageFile->extension();
        $originalName=Str::of($name)->basename('.'.$extention);

        $resultName=$originalName.'_'.time().'.'.$extention;
        // dd($originalName);
       $request->imageFile->storeAs('public/image',$resultName);
       return $resultName;
    }
}
