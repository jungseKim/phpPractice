<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <link href="{{ asset('css/app.css') }}" rel="stylesheet">
       <title>Document</title>
       <style>
              html,
              body {
                height: 100%;
              }
            
              @media (min-width: 640px) {
                table {
                  display: inline-table !important;
                }
            
                thead tr:not(:first-child) {
                  display: none;
                }
              }
            
              td:not(:last-child) {
                border-bottom: 0;
              }
            
              th:not(:last-child) {
                border-bottom: 2px solid rgba(0, 0, 0, .1);
              }
            </style>
</head>
      <!-- component -->
<body class="antialiased font-sans bg-gray-200">
       <div class="container mx-auto px-4 sm:px-8">
           <div class="py-8">
               <div>
                   <h2 class="text-2xl font-semibold leading-tight">Users</h2>
               </div>
               <div class="my-2 flex sm:flex-row flex-col">
                   <div class="block relative">
                       <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                           <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                               <path
                                   d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                               </path>
                           </svg>
                       </span>
                      <form class="flex">
                            <input placeholder="Search"
                            class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                           <button type=" submit" class="w-auto h-9 px-8 rounded-r-lg bg-yellow-400
                   text-gray-800 font-bold p-4 uppercase border-yellow-500 border-t border-b border-r inline-flex items-center">검색</button>
                     </form>
                   </div>
               </div>
               <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                   <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                       <table class="min-w-full leading-normal">
                           <thead>
                               <tr>
                                   <th
                                       class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       title
                                   </th>
                                   <th
                                       class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       name
                                   </th>
                                   <th
                                       class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Created at
                                   </th>
                                   <th
                                       class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       views
                                   </th>
                               </tr>
                           </thead>
                           <tbody>
                              @foreach ($posts as $post)
                              <tr>
                                   <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                       <div class="flex items-center">
                                           <div class="flex-shrink-0 w-10 h-10">
                                               <img class="w-full h-full rounded-full"
                                                   src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                   alt="" />
                                           </div>
                                           <div class="ml-3">
                                               <p class="text-gray-900 whitespace-no-wrap">
                                                <a href="{{ route('posts.show',['id'=>$post->id]) }}"> {{  $post->title}}</a>
                                               </p>
                                           </div>
                                       </div>
                                   </td>
                                   <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                       <p class="text-gray-900 whitespace-no-wrap"> {{  $post->user->name}}</p>
                                   </td>
                                   <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                       <p class="text-gray-900 whitespace-no-wrap">
                                          {{  $post->created_at}}
                                       </p>
                                   </td>
                                   <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                       <span
                                           class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                           <span aria-hidden
                                               class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                           <span class="relative"> {{  $post->viewCount()}}</span>
                                       </span>
                                   </td>
                               </tr>
                              @endforeach
                           </tbody>
                       </table>
                       <div
                           class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                           {{ $posts->withQueryString()->links() }}
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </body>
</html>