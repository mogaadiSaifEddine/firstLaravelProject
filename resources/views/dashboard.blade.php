@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <h4><a class="btn btn-primary" href="/posts/create">Create a new post ! </a></h4>
                    @if (count($posts)>0)
                    <table>
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($posts as $post )
                        <tr>
                            <td>{{$post->title}}</td>
                            <th><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit post</a></th>
                            <th>{!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {!!Form::close()!!}
                </th>
                        </tr>
                        @endforeach
                    </table>
                    @else 
                    <h4 >You have no posts yet !</h4>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
