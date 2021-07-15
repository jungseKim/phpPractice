<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        
    </x-slot>
        @extends('posts.test')
        @section('hi')
        @parent
        @endsection

      <div class="container mt-5 mb-5 ">
       
      
      <form method="GET" class="w-screen  mt-3 flex items-center" action="{{ route('posts.search') }}">
        <input type="text" name="name" class="w-9/12  h-18 rounded-l-lg p-4 border-t  border-b border-l text-gray-800 border-gray-200 bg-white"
        placeholder="search"/>
           <button type="submit" class="w-auto  h-18 px-8 rounded-r-lg bg-yellow-400
             text-gray-800 font-bold p-4 uppercase border-yellow-500 border-t border-b border-r inline-flex items-center">검색</button>
    </form>
    <div class="grid grid-cols-3 gap-4">
       @for($i=1;$i-1<count($posts);$i++)
        <!-- component -->
<!-- post card -->
<!-- component -->
<div class="max-w-4xl px-10 my-4 py-6 bg-white rounded-lg shadow-md">
       <div class="flex justify-between items-center">
           <span class="font-light text-xl hover:bg-gray-200 font-bold text-gray-600"><a href="{{ route('posts.show',['id'=>$posts[$i-1]->id,
              'page'=>$posts->currentPage()])}}">{{ $posts[$i-1]->title }}
              </a>
            </span >
           <p class="px-2 py-1 bg-gray-600  text-gray-100 font-bold rounded " >{{ $posts[$i-1]->created_at->diffForHumans() }}</p>
       </div>
       
       <div class="flex justify-between items-center mt-4">
       view: {{ $posts[$i-1]->viewCount()->count() }}
           <div>
               <a class="flex items-center" href="#">
                   <img class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block" src="{{$users->find($posts[$i-1]->user_id)->userImage() }}" alt="avatar">
                   <h1 class="text-gray-700 font-bold"><a href="{{ route('posts.userinfo',['id'=>$posts[$i-1]->user_id,'page'=>$posts->currentPage()]) }}">{{ $users->find($posts[$i-1]->user_id)->name }}</a></h1>
               </a>
           </div>
       </div>
   </div>
        @endfor
    </div>
       <div class="mt-4">
              {{ $posts->links() }}
       </div>
      </div>
    </x-app-layout>