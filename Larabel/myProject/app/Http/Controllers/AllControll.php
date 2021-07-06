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
        return view('/posts/index',compact('posts'));
    }
    public function show(Request $request,$id){
        $page=$request->page;
        $post=Post::find($id);
        $nickName=User::find($post->user_id)->name;
        
        return view('/posts/show',compact(['page','post','nickName']));
    }

    public function edit($id){
        $post=Post::find($id);
        return view('posts.edit',compact('post'));
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

        return redirect()->route('posts.show',['id'=>$id]);
        
    }  

    public function delete($id){
        return "delete";
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
