<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\models\Comment;
use App\models\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AllControll extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index', 'show']);
    }

    public function create()
    {
        return view('posts/create');
    }
    public function store(Request $request)
    {
        $title = $request->title;
        $content = $request->content;
        // dd($title.$content);
        $request->validate(
            [
                'title' => 'required|min:3',
                'content' => 'required',
                'image' => 'image|max:2000'
            ]
        );


        $post = new Post();
        $post->title = $title;
        $post->content = $content;
        $post->user_id = Auth::user()->id;
        if ($request->imageFile) {
            $post->image = $this->PathFind($request);
        }

        $post->save();

        return redirect('/posts/index');
    }

    public function index()
    {

        $posts = Post::latest()->paginate(6);

        $users = User::all();

        return view('/posts/index', compact('posts', 'users'));
    }
    public function show(Request $request, $id)
    {
        $page = $request->page;
        $where = $request->where;
        $post = Post::find($id);
        $next = null;
        $pre = null;
        $temps = null;
        if ($where == null) {
            $temps = DB::table('posts')->select('id')->latest()->get();
        } elseif ($where == 'my') {
            $temps = DB::table('posts')->select('id')->where('user_id', '=', auth()->user()->id)->latest()->get();
        } else {
            $temps = DB::table('posts')->select('id')->where('title', 'like', '%' . $where . '%')->latest()->get();
        }
        for ($i = 0; $i < count($temps); $i++) {
            if ($temps[$i]->id == $id) {
                // dd($temps[$i]->id);
                if ($i != 0) {
                    $pre = $temps[$i - 1]->id;
                }
                if ($i != count($temps) - 1) {
                    $next = $temps[$i + 1]->id;
                }
            }
        }


        // dd($pre . '_' . $next);
        $nickName = User::find($post->user_id)->name;


        $comments = Comment::where('post_id', $post->id)->get();
        $cUsers = User::all();


        // if(auth()->user()!=null){
        //     if(DB::table('post_user')->where([['user_id','=',auth()->user()->id],['post_id','=',$post->id]])->exists()==false){
        //         DB::table('post_user')->insert(['user_id'=>auth()->user()->id,
        //         'post_id'=>$post->id]);
        //     }
        // }
        if (Auth::user() != null && !$post->viewCount->contains(Auth::user())) //객체 를 줘도되고 객체 아이디줘도됨
        {
            $post->viewCount()->attach(Auth::user()->id);
        }

        return view('/posts/show', compact(['page', 'post', 'nickName', 'where', 'comments', 'cUsers', 'pre', 'next']));
    }

    public function edit(Request $request, $id)
    {
        $post = Post::find($id);
        $page = $request->page;

        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }
        $where = $request->where;
        return view('posts.edit', compact('post', 'page', 'where'));
    }
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $request->validate(
            [
                'title' => 'required|min:3',
                'content' => 'required',
                'imageFile' => 'image|max:2000'
            ]
        );
        if ($request->file('imageFile')) {
            $imagePath = 'public/image/' . $post->image;
            Storage::delete($imagePath);
            $post->image = $this->PathFind($request);
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        $page = $request->page;

        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }
        $where = $request->where;

        return redirect()->route('posts.show', ['id' => $id, 'page' => $page, 'where' => $where]);
    }

    public function delete(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post->image) {
            Storage::delete('public/image/' . $post->image);
        }
        $post->delete();
        $page = $request->page;

        if ($request->user()->cannot('delete', $post)) {
            abort(403);
        }

        if ($request->where == 'my') {
            return redirect()->route('posts.myIndex', compact('page'));
        }
        return redirect()->route('posts.index', compact('page'));
    }

    public function userinfo(Request $request, $id)
    {
        $user = User::find($id);
        $posts = Post::all();
        $page = $request->page;
        return view('posts.userInfo', compact('user', 'posts', 'page'));
    }

    public function myIndex()
    {
        $posts = auth()->user()->posts()->latest()->paginate(6);
        $user = auth()->user();
        // dd($posts);
        return view('posts.myIndex', ['posts' => $posts, 'user' => $user]);
    }


    public function Recommendation(Request $request, $id)
    {
        if (auth()->guest()) {
            return redirect()->route('posts.show', ['id' => $id, 'page' => $request->page, 'where' => $request->where]);
        }

        $post = Post::find($id);
        if (auth()->user() != null) {
            if (DB::table('recommendations')->where([['user_id', '=', auth()->user()->id], ['post_id', '=', $post->id]])->exists() == false) {
                DB::table('recommendations')->insert([
                    'user_id' => auth()->user()->id,
                    'post_id' => $post->id, 'good' => $request->bool ? 1 : 0
                ]);
            } else {
                $re3 = Recommendation::where([['user_id', '=', auth()->user()->id], ['post_id', '=', $post->id]])->first();

                if ($request->bool) {
                    DB::table('recommendations')
                        ->where('id', $re3->id)
                        ->update(['good' => true]);
                } else {
                    DB::table('recommendations')
                        ->where('id', $re3->id)
                        ->update(['good' => false]);
                }
            }
            return redirect()->route('posts.show', ['id' => $id, 'page' => $request->page, 'where' => $request->where]);
        }
    }       //search
    public function search(Request $request)
    {
        $posts = Post::where('title', 'like', '%' . $request->name . '%')->paginate(6);
        // dd($posts);
        $name = $request->name;

        return view('posts.search', compact('posts', 'name'));
    }



    public function PathFind(Request $request)
    {
        $name = $request->imageFile->getClientOriginalName();
        $extention = $request->imageFile->extension();
        $originalName = Str::of($name)->basename('.' . $extention);

        $resultName = $originalName . '_' . time() . '.' . $extention;
        // dd($originalName);
        $request->imageFile->storeAs('public/image', $resultName);
        return $resultName;
    }
}
