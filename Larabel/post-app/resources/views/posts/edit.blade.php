<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
           <h1 >수정</h1>
        <form action="{{ route('posts.update',['id'=>$post->id,'page'=>$page]) }}" method="post"
        enctype="multipart/form-data">
          @csrf
          {{-- 토큰을 이용한 사용자 인지 아닌지 확인  --}}
          @method('put')
          {{-- 이걸 하면 인풋 메소드 만들어줌 --}}
           {{-- method spoofing --}}
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" class="form-control" id="title"
               value="{{ old('title')?old('title'):$post->title }}">
                @error('title')
                    <div>{{ $message }}</div>
                @enderror
              
            </div>
            <div class="form-group">
              <label for="content">Content</label>
              <textarea class="form-control" name="content" id="content">{{ old('content')?old('content'):$post->content}}</textarea>
                @error('content')
                    <div>{{ $message }}</div>
                @enderror
            </div><br>
            <div class="form-group">
              <img class="img-thumbnail" width="20%"
              src="{{ $post->imagePath() }}">
       </div>
            <div class="form-group mt-2">
                <label for="file">File</label><br>
                <input class="form-control" type="file" name="imageFile" id="file">
                  @error('imageFile')
                      <div>{{ $message }}</div>
                  @enderror
              </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
</body>
</html>