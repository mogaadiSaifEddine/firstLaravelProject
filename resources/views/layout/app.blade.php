<!DOCTYPE html>
<html>
   <head>   
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lsapp</title>


   </head>
<body>
    @include('Inc.navBar')
    <div class = 'container'> 
          @include('Inc.messages')
        @yield('content')
     
    </div>
</body>


</html> 