<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function create(Request $request)
    {
        // dd($request->user_id.$request->post_id.$request->command);
        $c = new Comment();
        $c->user_id = $request->user_id;
        $c->post_id = $request->post_id;
        $c->content = $request->command;
        $c->save();

        return redirect()->route('posts.show', ['id' => $request->post_id, 'page' => $request->page, 'where' => $request->where]);
    }
    public function delete(Request $request, $id)
    {
        $c = Comment::find($id);
        $c->delete();
        return redirect()->route('posts.show', ['id' => $request->post_id, 'page' => $request->page, 'where' => $request->where]);
    }

    public function update(Request $request, $id)
    {
        // dd("ok");
        $request->validate(
            [
                'coment' => 'required',
            ]
        );
        $c = Comment::find($id);
        $c->content = $request->coment;
        $c->save();
        return redirect()->route('posts.show', ['id' => $request->post_id, 'page' => $request->page, 'where' => $request->where]);
    }
}
