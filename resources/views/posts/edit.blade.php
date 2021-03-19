@extends('layout.app')
@section ('content')
<h1>Create post</h1>
{!! Form::open(['action' => ['App\Http\Controllers\PostsController@update' , $post->id ], 'method'=>'PUT']) !!}
 <div class="form-group">
     {{Form::label('title','Title')}}
    {{Form::text('title','',['class'=>'form-control','placeholder'=>$post->title])}}
  </div> 
  <div class="form-group">

    {{Form::label('body','Body')}}
    {{Form::textarea('body','',['class'=>'form-control','placeholder'=>$post->body])}}
  </div>
  {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
  
  {!! Form::close() !!}

@endsection