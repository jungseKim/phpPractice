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
      <div class="container m-5">
       <div class=" mt-5 mb-3">
              <a class="btn btn-primary" href="{{ route('posts.index',['page'=>$page]) }}">목록 보기</a>
       </div>

       <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" readonly
               class="form-control" id="title" value="{{$post->title }}">
              
            </div>
            <div class="form-group">
              <label for="content">Content</label>
              <textarea class="form-control" name="content" id="content">{{ $post->content }}</textarea>
            </div>
            <div class="form-group">
              <label for="imageFile">이미지</label>
              <div >
                {{-- <img class="img-thumbnail" width="20%"  src="/storage/image/{{ $post->img ?? 'noimge.jpg' }}"/> --}}
                <img class="img-thumbnail" 
                width="20%"  
                src="{{ $post->imagePath() }}"/>
              </div>
              
            </div>

            <div class="form-group">
              <label>등록일</label>
              <input type="text" name="title" readonly
               class="form-control" value="{{$post->created_at->diffForHumans()}}">
              
            </div>
            <div class="form-group">
              <label>수정일</label>
              <input type="text" name="title" readonly
               class="form-control" value="{{$post->updated_at}}">
              
            </div>
            
            <div class="form-group">
              <label>작성자</label>
              <input type="text" name="title" readonly
               class="form-control" value="{{$user_name}}">
              
            </div>
      {{-- @if ($my=$post->user_id) --}}
      <div class="flex mt-3">
        <button class="btn btn-warning"
        onclick=location.href="{{ route('posts.edit',['id'=>$post->id]) }}">수정</button>
        <button class="btn btn-danger"
        onclick=location.href="{{ route('posts.delete',['id'=>$post->id])  }}">삭제</button>
       </div>
      {{-- @endif --}}
  
      </div>
</body>
</html>