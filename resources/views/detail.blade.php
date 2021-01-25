<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細画面</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
@extends('layouts.app')
@section('content')
    

    <a href="{{ route('posts,index') }}">戻る</a>

    @if (session('message'))
        <span>{{ (session('message')) }}</span>
    @endif

    <ul>
        <li>やらないこと：{{  $mainlists->content }}</li>
        <li>解決策：{{  $mainlists->solution }}</li>
        <li>投稿日：{{  $mainlists->created_at }}</li>
        <li>更新日：{{ $mainlists->updated_at }}</li>
        <li>投稿者：<a href="{{ route('users.show', $mainlists->user_id) }}">{{  $mainlists->user->name }}</a></li>
    </ul>

    @if ( Auth::id() == $mainlists -> user -> id  )
        <a href="{{route('edit', $mainlists->id) }}">編集</a>
    @endif

@endsection
</body>
</html>