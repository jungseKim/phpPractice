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
       <h2>user info</h2>
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
       <ul>
              @for ($i=0;$i<count($posts);$i++ )
                     @if ($posts[$i]->user_id=$user->id)
                         <li><a href="{{ route('posts.show',['id'=>$posts[$i]->id]) }}">{{ $posts[$i]->title }}</a></li>
                     @endif
              @endfor

       </ul>

</body>
</html>