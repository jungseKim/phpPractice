<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    public function imagePath(){
        $path=env('IMAGE_PATH');
        $name=$this->image??'noimge.jpg';
        return $path.$name;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function viewCount(){
        return DB::table('post_user')->where('post_id',$this->id)->count();
    }
    public function bad(){
        return  DB::table('recommendations')->where('post_id',$this->id)->where('good',false)->count();
    }
    public function good(){
        return  DB::table('recommendations')->where('post_id',$this->id)->where('good',true)->count();
    }
}
