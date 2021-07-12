<!DOCTYPE html>
<html lang="en">
<head>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
       <link href="{{ asset('css/app.css') }}" rel="stylesheet">
       <title>Document</title>
</head>
<body>
      
             
    
       <a href="/" class="mt-5 mr-5">메인화면</a>
       
      <div class="container mt-5 mb-5 ">
       <div class="mb-5 flex">
       <h1 class="display-3 "> 글목록 </h1>
      
       </div>
       
        @auth
      <a href="/posts/create" class="btn btn-primary">게시글 작성</a>
      @endauth
      <form method="GET" class="mt-3 ml-80 flex" action="{{ route('posts.search') }}">
        <input type="text" name="name" class="w-80  h-10 rounded-l-lg p-4 border-t ml-30 border-b border-l text-gray-800 border-gray-200 bg-white"
        placeholder="search"/>
           <button type="submit" class="w-auto  h-10 px-8 rounded-r-lg bg-yellow-400
             text-gray-800 font-bold p-4 uppercase border-yellow-500 border-t border-b border-r inline-flex items-center">검색</button>
    </form>
       
       @for($i=1;$i-1<count($posts);$i++)
        <!-- component -->
<!-- post card -->
<!-- component -->
<div class="max-w-4xl px-10 my-4 py-6 bg-white rounded-lg shadow-md">
       <div class="flex justify-between items-center">
           <span class="font-light text-xl font-bold text-gray-600"><a href="{{ route('posts.show',['id'=>$posts[$i-1]->id,
              'page'=>$posts->currentPage()])}}">{{ $posts[$i-1]->title }}</a></span>
           <p class="px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500" >{{ $posts[$i-1]->created_at->diffForHumans() }}</p>
       </div>
       
       <div class="flex justify-between items-center mt-4">
       view: {{ $posts[$i-1]->viewCount() }}
           <div>
               <a class="flex items-center" href="#">
                   <img class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block" src="{{$users->find($posts[$i-1]->user_id)->userImage() }}" alt="avatar">
                   <h1 class="text-gray-700 font-bold"><a href="{{ route('posts.userinfo',['id'=>$posts[$i-1]->user_id,'page'=>$posts->currentPage()]) }}">{{ $users->find($posts[$i-1]->user_id)->name }}</a></h1>
               </a>
           </div>
       </div>
   </div>
        @endfor
    
       <div class="mt-4">
              {{ $posts->links() }}
       </div>
      </div>
     
</body>
</html>