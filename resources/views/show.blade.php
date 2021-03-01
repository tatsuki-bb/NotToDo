<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー詳細画面</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
@extends('layouts.app')
@section('content')
    

    <a href="/post">戻る</a>
    <div class="page-title">
        <h1>{{ $user->name }}のやらないことリスト</h1>
    </div>
    

    <div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">

    @foreach($user->mainlists as $list) 
                       
        <div class="card">
            <div class="card-body">
                <div class="mylist-body">
                    <h2>{{ $list->content }}</h2>
    
                    <a href="{{ route('post.show',$list->id) }}">詳細</a>

                    @php
                        $i = 1
                    @endphp
                </div>
            </div>
        </div>

    @endforeach

    @if(empty($i))
        <h3>未登録</h3>
    @endif

    </div>
    </div>
    </div>
@endsection
    
</body>
</html>