<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <title>Document</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
            function button(id) {
              // event.preventDefault();
              // event.stopPropagation();
                    let text=document.getElementById(id);
                    let t2=text.innerText;
                    // let t2="hiii";
                    text.innerHTML=`<input type='text' name='coment' id='c_d' value=${t2} >`;
                    // document.getElementById("c_d").value =t2;

                    let button=document.getElementById(id+"bt");
                    button.innerHTML=`<button onclick="send(${id})">완료</button>`;
                    // button.onclick=send(${id+"fo");
                    //1 자스로 태그 바꿔주기 라우터 이동 x
                    //2 form 으로 라우터 이동한후 리다이렉트 
                  
                }
            function send(id){
              let fo=document.getElementById(id+"fo");
              fo.submit();
            }
  </script>
  </head>
<body>
      <div class="container">
        <div class="row">
          <div class="col-1">
            @if ($pre!=null)
               <a class="btn btn-primary" href="{{ route('posts.show',['id'=>$pre,'page'=>$page,'where'=>$where]) }}">이전</a>
            @endif
          </div>
        
       <div class="col-10 mt-5 mb-3">
              @if ($where==null)
              <a class="btn btn-primary" href="{{ route('posts.myIndex',['page'=>$page]) }}">목록 보기</a>
              @elseif ($where=='my')
              <a class="btn btn-primary" href="{{ route('posts.index',['page'=>$page]) }}">목록 보기</a>
              @else
              <a class="btn btn-primary" href="{{ route('posts.search',['page'=>$page,'name'=>$where]) }}">목록 보기</a>
              @endif
       

       <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" readonly
               class="form-control" id="title" value="{{$post->title }}">
              
            </div>
            <div class="form-group">
              <label for="content">Content</label>
              <div class="form-control" name="content" id="content">{!! $post->content !!}</div>
            </div>
            <div class="form-group">
                   <label for="image">이미지</label><br>
                   <img class="img-thumbnail" width="20%" src="/storage/image/{{ $post->image?? 'noimge.jpg' }}">
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
               class="form-control" value="{{ $nickName }}">
            </div>
           
            @can('update',$post)
              <div class="position-relative">
                   <table class="position-relative start">
                       <tr>
                              <td>
                  <button class="btn btn-warning"
                   onclick=location.href="{{ route('posts.edit',['id'=>$post->id,'page'=>$page,'where'=>$where]) }}">수정</button>
                             </td>
                              <td>
                   <form action="{{ route('posts.delete',['id'=>$post->id,'page'=>$page,'where'=>$where]) }}" method="post">
                     @csrf
                     @method('delete')
                     <button type="submit" class="btn btn-danger">삭제</button>
                       </form>  
                               </td>
                               </tr>
                 </table>
                    </div> 
                    @endcan

                    
                   <div class="position-relative">
                    <table class="position-absolute  start-59">
                        <tr>
                               <td>
                           <form action="{{ route('posts.Recommendation',['id'=>$post->id,'page'=>$page,'where'=>$where,'bool'=>1]) }}" method="post">
                              @csrf
                              @method('put')
                            <button type="submit" class="btn btn-warning">추천{{ $post->good() }}</button>
                          </form>   
                          </td>
                                    <td>
                          <form action="{{ route('posts.Recommendation',['id'=>$post->id,'page'=>$page,'where'=>$where,'bool'=>0]) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-danger">비추천{{ $post->bad() }}</button>
                              </form>  
                                </td>
                                </tr>
                     </table>
                        </div> 
                      
            
                   
                    <br>
                    <h2 class="text-center">댓글</h2>
                    @if ($comments!=null)
                    <table class="table table-striped table-sm">
                      <tr>
                        <td><h5>name</td>
                        <td><h5>comment</h5></td>
                        <td><h5>time</h5></td>
                        <td><h5></h5></td>
                      </tr>
                    @foreach ($comments as $commnet )
                   <tr>
                     <td> 
                      {{$cUsers->find($commnet->user_id)->name}}
                     </td>
                     <td>
                      <form id="{{ $commnet->id }}fo"  action="{{ route('comment.update',['id'=>$commnet->id,'post_id'=>$post->id,'page'=>$page,'where'=>$where]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <span  id="{{ $commnet->id }}" >{{$commnet->content}}</span>
                      
                      </form>
                      </td>
                     <td>
                       {{ $commnet->created_at->diffForHumans() }}
                     </td>
                     <td>
                       @can('delete',$commnet)
                        <div class="flex items-stretch ">
                          <button id="{{ $commnet->id }}bt" onclick="button({{ $commnet->id }})">수정</button>
                          <form action="{{ route('comment.delete',['id'=>$commnet->id,'post_id'=>$post->id,'page'=>$page,'where'=>$where]) }}" method="post">
                           @csrf
                           @method('delete')
                           <button type="submit">삭제</button>
                        </div>
                       @endcan
                     </td>
                   </tr>
                    @endforeach
                    </table>
                    @endif
                    
                   @auth
                   <form action="{{ route('comment.create',['user_id'=>auth()->user()->id,'post_id'=>$post->id,'page'=>$page,'where'=>$where]) }}" method="post">
                    @csrf
                    <input type="text" name="command">
                     <button type="submit" class="btn btn-primary">댓글</button>
                   </form>
                   @endauth
                   </div>
                   
                <div class="col-1 items-center">
                       @if ($next!=null)
               <a class="btn btn-primary" href="{{ route('posts.show',['id'=>$next,'page'=>$page,'where'=>$where]) }}">다음</a>
                       @endif
                 </div>     
        </div>
      </div>
</body>
</html>