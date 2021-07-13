<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
class GitHubController extends Controller
{
   public function __construct()
   {
       $this->middleware(['guest']);
   }
   public function redirect(){
    return Socialite::driver('github')->redirect();
   }

   public function callback(){
    return $user = Socialite::driver('github')->user();
    dd($user);
   }
}
