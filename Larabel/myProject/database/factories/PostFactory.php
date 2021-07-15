<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public $users=null;
    public function __construct()
    {
        parent::__construct();
        $this->users=User::all();
    }
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>$this->users->random()->id,
            'title'=>$this->faker->text(10),
            'content'=>$this->faker->sentence()
        ];
    }
}
