<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <title>Document</title>
       <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
                
       <div class="bg-white shadow-xl rounded-lg py-3">
              <form action="{{ route('users.profileUpdate',['id'=>auth()->user()->id]) }}"  method="post"
              enctype="multipart/form-data">
                     @csrf
                     @method('put')

              <div class="photo-wrapper p-2">
                  <img class="w-30 h-30 rounded-full mx-auto" src="{{ $user->userImage() }}" alt="John Doe">
                  
                  <div class="container m-5">
                     <div class="form-group mb-4">
                            <label for="file">사진</label><br>
                            <input type="file" name="imageFile" id="file">
                          </div>
                          @error('imageFile')
                          {{ $message }}
                   @enderror
                         
                     <div class="form-group">
                            <label>닉내임</label>
                            <input type="text" name="name" 
                             class="form-control" value="{{$user->name}}">
                          </div>
                          @error('name')
                          {{ $message }}
                     @enderror
                     <div class="form-group">
                            <label>이메일</label>
                            <input  type="text" name="email"
                             class="form-control" value="{{$user->email}}">
                          </div>
                          @error('email')
                           이메일 형식에 어긋납니다 
                   @enderror
                     <div class="form-group">
                            <label>가입 날짜</label>
                            <input type="text" name="day" readonly
                             class="form-control" value="{{$user->created_at}}">
                          </div>
              </div>
              <button type="submit" class="mt-3 mx-auto text-center w-60 h-20 px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500">
                   변경 완료</button>
              </div>
       </form>
       </div>
              
</body>
</html>