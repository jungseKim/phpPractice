<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $name='김정세';
        return view('test.show',compact('name'));
    }
}
