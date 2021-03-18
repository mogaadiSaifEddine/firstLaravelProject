@extends('layout.app')
@section('content')
<head>
    <link rel="stylesheet" href="/css/app.css">
</head>
    <h1>WELCOME TO OUR SERVICE PAGE</h1>
    <P>this is the services section</P>
    @if(count($services)>0)
    <ul>
        @foreach ($services as $service)
            <li>{{$service}}</li>
        @endforeach

    @endif
    @endsection
