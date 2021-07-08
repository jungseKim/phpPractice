<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <title>Document</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body> 
       <button class="btn btn-primary m-4"
       onclick=location.href="{{ route('posts.index',['page'=>$page]) }}">목록보기</button>
       <h1 class="text-center">user info</h1>
       <div class="container ">
              <div class="form-group">
                     <label>닉내임</label>
                     <input type="text" name="name" readonly
                      class="form-control" value="{{$user->name}}">
                   </div>
              <div class="form-group">
                     <label>이메일</label>
                     <input type="text" name="email" readonly
                      class="form-control" value="{{$user->email}}">
                   </div>
              <div class="form-group">
                     <label>가입 날짜</label>
                     <input type="text" name="day" readonly
                      class="form-control" value="{{$user->created_at}}">
                   </div>
       </div>

       <br>
       
       <br>
       <div class="container">
       <h2>글 목록</h2>
       <div class="list-group">
              @for ($i=0;$i<count($posts);$i++ )
                     @if ($posts[$i]->user_id==$user->id)
                         <a href="{{ route('posts.show',['id'=>$posts[$i]->id]) }}"  class="list-group-item list-group-item-action">{{ $posts[$i]->title }}</a>
                     @endif
              @endfor
       </div>
       </div>
</body>
</html>