<!DOCTYPE html>
<html lang="en">
<head>
  <style>
  .mb-3{color:blue;}
  .form-control{background-color:skyblue;}
  </style>
</head>
<body>

    <form action="/posts/store" method="post">
        @csrf
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">제목</label>
          <input type="text" class="form-control" name="title" id="exampleFormControlInput1" placeholder="제목을 써주세요"
          size="20"  >
        </div>
        <br>

        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">내용</label>
          <textarea class="form-control" name="content" id="exampleFormControlTextarea1"
          cols="40" rows="13"></textarea>

          <button>확인</button>
     
        </div>
        </form>
  
</body>
</html>