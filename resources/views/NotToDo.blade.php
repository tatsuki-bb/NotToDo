<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>やらないことリスト</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($mainlists as $list) 
                        <ul>
                            <li>やらないこと：{{ $list -> content }}</li>
                            <li>解決策：{{ $list -> solution }}</li>
                            <li>投稿日：{{ $list -> created_at }}</li>
                            <li>投稿者：<a href="{{ route('users.show',$list->user_id) }}">{{ $list->user->name }}</a></li>
                        </ul>
                        <a href="{{ route('post.show',$list->id) }}">詳細</a>
                    @endforeach

                    
                  
                </div>
            </div>
        </div>
    </div>
    {{ $mainlists->links('pagination::bootstrap-4') }}
</div>
<!-- <a href="/post/create">リスト登録</a> -->
@endsection
</body>
</html>

