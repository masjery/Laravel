@extends('layouts.app')
    @section('content')
 
 @if(count($posts) > 0 )
  <h1 class="container">Posts</h1>
   @foreach($posts as $post)
    <div class="container well card">
       <div class="row">
           <div class="col-md-4 col-sm-4">
        <img style="width:100%" src="/storage/cover_images/{{ $post->cover_image}} ">  

           </div>
           <div class="col-md-8 col-sm-8">
              <h3><a href="post/{{$post->id}}"> {{$post->title}}</a> </h3>
        <small>written on {{$post->created_at}}</small>  
           </div>
       </div>
       
        
           
    </div>
   @endforeach
   {{$posts->links()}}
   @else
   <p>No post is found</p>
  
  @endif
   @endsection
    