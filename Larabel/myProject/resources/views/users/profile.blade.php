<x-app-layout>
       <x-slot name="header">
           <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               {{ __('Dashboard') }}
           </h2>
           
       </x-slot>
       <div class="bg-red bg-opacity-25 shadow-xl rounded-lg py-3">
              <div class="photo-wrapper p-2 items-center border-4">
                  <img class="w-80 h-80 rounded-full mx-auto" src="{{ $user->userImage() }}" >
              </div>
       </div>
                  <div class="flex flex-col container mx-auto items-center  ">

                     <div class="m-5 mt-10">
                            <label class="text-lg font-bold">닉내임 </label>
                            <input class="border-4 border-light-blue-500 border-opacity-25 rounded-lg" type="text" name="name" readonly
                              value="{{$user->name}}">
                          </div>
                     
                          <div class="m-5">
                            <label class="text-lg font-bold">이메일 </label>
                            <input  type="text" name="email" readonly
                            class="border-4 border-light-blue-500 border-opacity-25 rounded-lg" value="{{$user->email}}">
                          </div>
                     <div class="m-5 ml-5" >
                            <label class="text-lg font-bold">등록일 </label>
                            <input type="text" name="day" readonly
                            class="border-4 border-light-blue-500 border-opacity-25 rounded-lg" value="{{$user->created_at}}">
                          </div>
                          
                     <a class="mt-3 text-center  text-3xl w-60 h-20 px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500" href="{{ route('users.profileEdit') }}">프로필 변경</a>
              </div>
              <div class="flex items-center" ></div>
                 
       
              
</x-app-layout>