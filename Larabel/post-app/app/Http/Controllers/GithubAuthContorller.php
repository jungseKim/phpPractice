<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
class GithubAuthContorller extends Controller
{
    public function __construct()
    {
     $this->middleware(['guest']); 
    }

    public function redirect(){
        return Socialite::driver('github')->redirect();
    }

    public function callback(){
        $user = Socialite::driver('github')->user();
        // dd($user);

        //db 에 사용자 정보를 저장한다
        //이미  이 사용자 정보가 db에 저장되어 있다면 
        //저장할 필요가 없다.
        //첫번째 인자는 검색조건 
        //두번째는 레코드 삽입 찾으면 리턴
        $user=User::firstOrCreate(['email'=>$user->getEmail()],
            ['password'=>Hash::make(Str::random(24)),
            'name'=>$user->getName()]);
        //모델에 클래스에 이걸 기술해줘야됨 user->fillable;
        
        //로그인 처리
        Auth::login($user);

        //원래가려고 했던 곳으로 보내는메소드 디폴드 값
        return redirect()->intended('/dashboard');
    }
}
