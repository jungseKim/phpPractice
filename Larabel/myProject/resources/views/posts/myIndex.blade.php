<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        
    </x-slot>
    <div class="container mt-5 mb-5">
       @auth
        <a href="/posts/create" class="btn btn-primary">게시글 작성</a>
        @endauth
        <div class="grid grid-cols-3 gap-4">

        @foreach($posts as $post)
           
            <div class="max-w-4xl px-10 my-4 py-6 bg-white rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <span class="font-light hover:bg-gray-200 text-xl font-bold text-gray-600"><span>             
                        <a href="{{ route('posts.show',
                        ['id'=>$post->id,'page'=>$posts->currentPage(),'where'=>'my']) }}">
                            {{ $post->title}}
                        </a>
                    </span>
                    <p class="px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded " >{{ $post->created_at->diffForHumans() }}</p>
                </div>
                
                <div class="flex justify-between items-center mt-4">
                view: {{ $post->viewCount() }}
                    <div>
                        <a class="flex items-center" href="#">
                            <img class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block" src="{{$user->userImage() }}" alt="avatar">
                            <h1 class="text-gray-700 font-bold"><a href="{{ route('posts.userinfo',['id'=>$post->user_id,'page'=>$posts->currentPage()]) }}">{{ $user->name }}</a></h1>
                        </a>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
          <div class="mt-5">
              {{ $posts->links() }}
          </div>
    </div>
    
</x-app-layout>