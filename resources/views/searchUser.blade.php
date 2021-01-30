<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー検索</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>

<body>

@extends('layouts.app')
@section('content')

<a href="{{ route('users.index') }}">フォロワー一覧に戻る</a>

<h3>ユーザー名を入力してください</h3>
<form action="/searching" method="POST">
{{ csrf_field() }}
@method('POST')

<input type="text" id="search" name="search" value="">
<button type="submit">検索</button>
@if ($errors->has('search'))
    <div class="alert alert-danger mt-3">
        @foreach ($errors->get('search') as $error)
            {{ $error }}
        @endforeach
    </div>
@endif

</form>
   @if(isset($searchedUsers))
    @foreach($searchedUsers as $user)
        @if(in_array($user->id,Auth::user()->follow())) 
        <ul>
            <li>{{ $user->name }}</li>
            <li>{{ $user->id }}</li>
        
        </ul>
        
        <form action="{{ route('searchUnfollow',$user->id) }}" method="POST">
            {{ csrf_field() }}
            @method('DELETE')
                <button type="submit" class="btn btn-primary">フォロー解除</button>
        </form>

        @else
        <ul>
            <li>{{ $user->name }}</li>
            <li>{{ $user->id }}</li>
        
        </ul>

        <form action="{{ route('searchFollow') }}" method="POST">
            {{ csrf_field() }}
            @method('POST')
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="follow_id" value="{{ $user->id }}">
                <button type="submit" class="btn btn-primary">フォロー</button>
        </form>

        @endif


    @endforeach
    @if (session('$searchUnfollowing'))
        <span>{{ (session('$searchUnfollowing')) }}</span>
    @endif

    @if (session('searchFollowing'))
        <span>{{ (session('searchFollowing')) }}</span>
    @endif

    

   @endif

   

@endsection
</body>