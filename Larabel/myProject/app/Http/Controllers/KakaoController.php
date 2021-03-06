<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
class KakaoController extends Controller
{
    public function redirect(){
        return Socialite::driver('kakao')->redirect();
    }
    public function callback(){
    
        $user = Socialite::driver('kakao')->stateless()->user();
        $users=User::firstOrCreate(['email'=>$user->getEmail()],
        ['password'=>Hash::make(Str::random(24)),
        'name'=>$user->getName()
        ]
         );

        Auth::login($users);
        
        return redirect()->intended('/dashboard');
    }
}
