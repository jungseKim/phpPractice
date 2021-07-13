<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);  
    }

    public function profile(){
        $user=Auth::user();
        return view('users.profile',compact('user'));
    }

    public function profileedit( ){
       $user=Auth::user();
        return view('users.profile_edit',compact('user'));
    }

    public function profileUpdate(Request $request,$id){
        $user=User::find($id);
        
        $request->validate(
            [
                'name'=>'required|min:3',
                'email'=>'required|email:rfc,dns',
                'imageFile'=>'image|max:2000'
            ]
            );
        $user->name=$request->name;
        $user->email=$request->email;
       
        if($request->file('imageFile')){
            if($user->myImage!=null){
               Storage::delete('public/userImage'.$user->userImage());
            }
            $request->file('imageFile')->storeAs('public/userImage',$user->userImage());
            $user->myImage=$user->userImage();
        }
      
        $user->save();
        return redirect()->route('users.profile');

    }
    
}
