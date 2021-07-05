<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    //php artisan pinker 
    //$post -> name ='content';

    //태이블 바꾸기
    //proted $table='my_table' 
    
    use HasFactory;
    
    public function imagePath(){
        // $path='/storage/image/';
        $path=env('IMAGE_PATH','/storage/image/');
        $imageFile=$this->img??'noimge.jpg';
        return $path.$imageFile;
    }
}
