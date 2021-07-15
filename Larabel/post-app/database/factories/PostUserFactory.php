<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use PHPUnit\Framework\Constraint\Count;

class PostUserFactory extends Factory
{
    protected $users=null;
    protected $posts=null;
    public $userId=null;
    public $postId=null;
    public $count=0;

    public function __construct()
    {   
        parent::__construct();
        $this->users=User::all();
        $this->posts=Post::all();    
    }

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        do{
            $this->userId=$this->users->random()->id;
            $this->postId=$this->posts->random()->id;
            $postUSer=PostUser::where('user_id',$this->userId)->where('post_id',$this->postId)->get();
        }while($postUSer->count()!=0);
        return [
           'user_id'=>$this->userId,
           'post_id'=>$this->postId,
        ];

        // while($this->count){
        //     $this->userId=$this->users->random()->id;
        //     $this->postId=$this->posts->random()->id;
        //     $postUSer=PostUser::where('user_id',$this->userId)->where('post_id',$this->postId)->get();
        //     if($postUSer->count()!=0){

        //     }
        // }
        
    }
}
