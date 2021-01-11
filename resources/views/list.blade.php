<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>やらないことリスト</title>
</head>
<body>
@extends('layouts.app')
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

                    @foreach($posts as $post) 
                        <ul>
                            <li>{{ $post -> title }}</li>
                            <li>{{ $post -> content }}</li>
                            <li>{{ $post->category->category_name }}</li>
                            <li>{{ $post->user->name }}</li>
                        </ul> 
                        <a href="{{ route('post.show',$post->id) }}">詳細</a>
                    @endforeach
                  
                </div>
            </div>
        </div>
    </div>
</div>
{{ __('You are logged in!') }}
@endsection
</body>
</html>