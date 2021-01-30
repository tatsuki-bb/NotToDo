<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}さんのやらないことリスト</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
    
@extends('layouts.app')
@section('content')
    
    
    <a href="/post">戻る</a>
    {{ $user->name }}のやらないことリスト

        @foreach($user->mainlists as $list) 
                        <ul>
                            <li>やらないこと：{{ $list->content }}</li>
                            <li>解決策：{{ $list->solution }}</li>
                            <li>投稿日：{{ $list->created_at }}</li>
                            <li>更新日：{{ $list->updated_at }}</li>
                        </ul>
                        <a href="{{ route('post.show',$list->id) }}">詳細</a>
                        @php
                            $i = 1
                        @endphp
        @endforeach
    @if(empty($i))
        <h3>さっそく"やらないこと"を登録しよう</h3>
    @endif
                  
@endsection
</body>

</html>