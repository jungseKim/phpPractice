<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
