<!DOCTYPE html>
<html lang="en">
<head>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
       <title>Document</title>
</head>
<body>
       
       <a href="/" class="mt-5 mr-5">메인화면</a>
 
      <div class="container mt-5 mb-5">
        @auth
      <a href="/posts/create" class="btn btn-primary">게시글 작성</a>
      @endauth
       <ul class="list-group mt-3">
       @foreach ($posts as $post)
        <li class="list-group-item">
             <span><a href="{{ route('posts.show',['id'=>$post->id]) }}">title: {{ $post->title }}</a></span>
             <br>
             <span>wirted on:{{ $post->created_at }}</span>
        </li>   
        @endforeach
       </ul>

      </div>
</body>
</html>