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
       <form method="GET" class="mt-3 ml-20 flex" action="{{ route('posts.search') }}">
              <input type="text" name="name" class="w-30  h-10 rounded-l-lg p-4 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white"/>
                 <button type="submit" class="w-auto  h-10 px-8 rounded-r-lg bg-yellow-400
                   text-gray-800 font-bold p-4 uppercase border-yellow-500 border-t border-b border-r inline-flex items-center">검색</button>
          </form>
       </div>
        @auth
      <a href="/posts/create" class="btn btn-primary">게시글 작성</a>
      @endauth
      <table class="table table-striped mt-4">
       <thead class="table-dark">
       <tr>
              <td><h3>#</h3></td>
              <td><h3>Title</h3></td>
              <td><h3>Time</h3></td>
              <td><h3>User</h3></td>
              <td><h3>view</h3></td>
       </tr>
       </thead>
       @for($i=1;$i-1<count($posts);$i++)
               <tr>
                     <td>{{ $i }}</td>
                     <td><a href="{{ route('posts.show',['id'=>$posts[$i-1]->id,
                     'page'=>$posts->currentPage()])}}">{{ $posts[$i-1]->title }}</a></td>
                     <td>{{ $posts[$i-1]->created_at }}</td>
                     <td><a href="{{ route('posts.userinfo',['id'=>$posts[$i-1]->user_id,'page'=>$posts->currentPage()]) }}">{{ $users->find($posts[$i-1]->user_id)->name }}</a></td>
                     <td>{{ $posts[$i-1]->viewCount() }}</td>
              </tr>
        
        </li>   
        @endfor
       </table>
       <div class="mt-4">
              {{ $posts->links() }}
       </div>
      </div>
     
</body>
</html>