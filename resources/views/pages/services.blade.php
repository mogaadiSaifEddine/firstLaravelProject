@extends('layout.app')


@section('content')


    <h1>WELCOME TO OUR SERVICE PAGE</h1>
    <P>this is the services section</P>
    @if(count($services)>0)
    <ul  class="list-group">
        @foreach ($services as $service)
           <a href="#"> <li   class="list-group-item">{{$service}}</li></a>
        @endforeach

    @endif

    @endsection
    </html>

    
