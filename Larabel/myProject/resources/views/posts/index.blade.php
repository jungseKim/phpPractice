<!DOCTYPE html>
<html lang="en">
<head>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
       <title>Document</title>
</head>
<body>
       
       <a href="/" class="mt-5 mr-5">메인화면</a>
       
      <div class="container mt-5 mb-5 ">
       <h1 class="display-5 "> 글목록 </h1>
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