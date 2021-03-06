<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
</head>
<body>
    <div class="container">
        <form action="/posts/store" method="post"
        enctype="multipart/form-data">
          @csrf
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" class="form-control" id="title"
               value="{{ old('title') }}">
                @error('title')
                    <div>{{ $message }}</div>
                @enderror
              
            </div>
            <div class="form-group">
              <label for="content">Content</label>
              <textarea class="form-control" name="content" id="content">{{ old('content') }}</textarea>
                @error('content')
                    <div>{{ $message }}</div>
                @enderror
            </div><br>

            <div class="form-group mb-4">
                <label for="file">File</label><br>
                <input type="file" name="imageFile" id="file">
                  @error('imageFile')
                      <div>{{ $message }}</div>
                  @enderror
              </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script>
        ClassicEditor
                .create( document.querySelector( '#content' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                } );
    </script>
    
</body>
</html>