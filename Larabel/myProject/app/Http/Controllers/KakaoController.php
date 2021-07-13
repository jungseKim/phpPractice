<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
class KakaoController extends Controller
{
    public function redirect(){
        return Socialite::driver('kakao')->redirect();
    }
    public function callback(){
        dd('ok');
    }
}
