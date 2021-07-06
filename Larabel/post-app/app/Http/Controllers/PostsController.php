<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

            //검사  오류나면 자동으로 전 페이지로 리다이렉션 시켜줌
            $request->validate(
                [
                'title'=>'required|min:3',
                'content'=>'required',
                'imageFile'=>'image|max:2000'
                ]
            );

            // dd($request);

            //디비에 저장 하고 

            $post=new Post();
            $post->title=$title;
            $post->content=$content;
            $post->user_id=Auth::user()->id;

            //파일 처리
            //원하는 파일 시스템 위치에 원하는 이름으로 
            //파일을 저장하고 
             //그 파일 이름을칼럼에 설정 
            
            if($request->file('imageFile')){
                $post->img=$this->uploadPostImage($request);
            }
         
            $post->save();

            //결과 뷰를 반환 
            //리다이렉션 안했을때 뷰는 이거고 링크는 store그대로임 

           return redirect('/posts/index');
    
            //get 방식요청 view return
            //post 방식은 redirection 

        }
    
   
    //쿼리 스트링 하고 url 구분하기
    public function show(Request $request,$id){
        //파라미터로 받을때 항상 리퀘스트 객체가 먼저있어야됨
        
        // dd($request->page);
        $page=$request->page;
        $post=Post::find($id);
        $user_name=User::find($post->user_id)->name;
        // dd($user_name);
        $my=Auth::id();
        return view('posts.show',compact('post','page','user_name','my'));
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
    public function edit($id){
        //이렇게 하면 알아서 찾아서 달라는거 맞춰서 준다
        $post=Post::find($id);
        // $post=Post::find($id);
        // dd($post);
        return view('posts.edit')->with('post',$post);
    }
    public function update(Request $request,$id){
        
        //validation
        $request->validate(
            [
            'title'=>'required|min:3',
            'content'=>'required',
            'imageFile'=>'image|max:2000'
            ]
        );
        $post=Post::find($id);
        //게시글을 데이터 베이스에서 수정

        //사진일 경우 기존파일 삭제 후 업데이트 
        if($request->file('imageFile')){
            $imagePath='public/image/'.$post->img;
            Storage::delete($imagePath);
            $post->img=$this->uploadPostImage($request);
        }


        
        
        $post->title=$request->title;
        $post->content=$request->content;
        $post->save();
        
        return redirect()->route('posts.show',['id'=>$id]);
        
    }
    public function destroy(){
        //파일 시스템에서 이미지 파일 삭제
        //게시글을 데이터 베이스에서 삭제 
    }
    protected function uploadPostImage(Request $request){
        $name=$request->file('imageFile')->getClientOriginalName();
            
                $extension=$request->file('imageFile')->extension();
                $originalName=Str::of($name)->basename('.'.$extension);
                
                $fileName=$originalName.'_' .time().'.'.$extension;
                // dd($fileName);
    
                $request->file('imageFile')->storeAs('public/image',$fileName);
                return $fileName;
    }
}
