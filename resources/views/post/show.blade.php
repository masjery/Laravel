@extends('layouts.app')
    @section('content')
    
     <a href="/post" class="btn btn-outline-primary btn-lg" role="button">Go back </a>
 

  <h1>{{$post->title}}</h1>
 <img style="width:100%" src="/storage/cover_images/{{ $post->cover_image}} ">  

 
  <div>
      {!!$post->body!!}
  </div>
  <hr>
   <small>written on{{$post->created_at}}</small>
   <hr>
   @if(!Auth::guest())
    @if(Auth::User()->id == $post->User_id)
   <a href="/post/ {{$post->id}} /edit" class="btn btn-outline-primary">Edit</a>

            {!! Form::open(['action' => ['postcontroller@destroy',$post->id],'method'=> 'POST','class' => 'float-right']) !!}
            {{Form::hidden('_method','DELETE')}} 
            {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
    @endif
  @endif
   @endsection