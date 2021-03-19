@extends('layout.app')

@section('content')

<a class="btn btn-outline-light" href="/posts">Go back to Posts</a>
<h1>{{$post->title}}</h1>
<p>{{$post->body}}</p>
<small>{{$post->created_at}}</small>
<br>
<br>
<br>
<br>
<br>
<br>

@endsection 