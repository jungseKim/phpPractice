<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
class GoogleController extends Controller
{
    public function redirect(){
       return Socialite::driver('google')->redirect();
    }
    public function callback(){
        $user = Socialite::driver('google')->user();
        $users=User::firstOrCreate(['email'=>$user->getEmail()],
        ['password'=>Hash::make(Str::random(24)),
        'name'=>$user->getName()
        ]
         );

        Auth::login($users);
        
        return redirect()->intended('/dashboard');
    }
}
