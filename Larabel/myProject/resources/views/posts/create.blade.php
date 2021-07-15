<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
      
  </x-slot>

    
        <form action="/posts/store" method="post"
        enctype="multipart/form-data">
          @csrf
           <!-- component -->
<div class="heading text-center font-bold text-2xl m-5 text-gray-800">New Post</div>
<style>
  body {background:white !important;}
</style>
  <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
    <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" spellcheck="false" placeholder="Title" type="text" name="title" id="title" value="{{ old('title') }}">
    @error('title')
    <div>{{ $message }}</div>
  @enderror
    <textarea class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none" spellcheck="false" placeholder="Describe everything about this post here"  name="content" id="content"
    value="{{ old('content') }}"></textarea>
    @error('content')
    <h1>{{ $message }}</h1>     
    @enderror
    
    <!-- icons -->
    <div class="icons flex text-gray-500 m-2">
      <div class="form-group mb-4">
        <label for="file">File</label><br>
        <input type="file" name="imageFile" id="file">
      </div>
      @error('image')
          <div>{{ $message }}</div>
      @enderror </div>
    <!-- buttons -->
    <div class="buttons flex">
      <button type="button" onClick={{ back() }}  class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto">Cancel</button>
      <button type="submit" class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500">Submit</button>
    </div>
  </div>
      
  </form>
    
    {{-- <script>
      ClassicEditor
              .create( document.querySelector( '#content' ) )
              .then( editor => {
                      console.log( editor );
              } )
              .catch( error => {
                      console.error( error );
              } );
</script> --}}
</x-app-layout>