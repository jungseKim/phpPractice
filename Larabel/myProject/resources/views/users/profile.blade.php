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
       <a class="m-10 w-100 btn btn-primary" href="{{ route('dashboard') }}">완료</a> 
       <div class="bg-white shadow-xl rounded-lg py-3">
              <div class="photo-wrapper p-2 items-center">
                  <img class="w-30 h-30 rounded-full mx-auto" src="{{ $user->userImage() }}" alt="John Doe">
                  
                  <div class="container m-5">
                     <div class="form-group">
                            <label>닉내임</label>
                            <input type="text" name="name" readonly
                             class="form-control" value="{{$user->name}}">
                          </div>
                     <div class="form-group">
                            <label>이메일</label>
                            <input  type="text" name="email" readonly
                             class="form-control" value="{{$user->email}}">
                          </div>
                     <div class="form-group">
                            <label>가입 날짜</label>
                            <input type="text" name="day" readonly
                             class="form-control" value="{{$user->created_at}}">
                          </div>
              </div>
              <h1 class="mt-3 mx-auto text-center w-60 h-20 px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500">
                     <a href="{{ route('users.profileEdit') }}">프로필 변경</a></h1>
                 
              </div>
       </div>
              
</body>
</html>