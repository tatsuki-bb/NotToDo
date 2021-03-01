<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フォロワー</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>

<body>

@extends('layouts.app')

@section('content')


@if (session('unfollowing'))
    <span>{{ (session('unfollowing')) }}</span>
@endif

@if (session('following'))
    <span>{{ (session('following')) }}</span>
@endif

    <div class="container">
       
        
        <div class="row justify-content-center">
            <div class="col-md-8">

            <div class="follower-head">
            <h1>フォロワー</h1>
            <a href="{{ route('searchUser')}}">ユーザーを探す</a>
            </div>
               <h2>相互フォロワー</h2>

                @foreach ($all_users  as $user)
                    @if(in_array($user->id,Auth::user()->follow_each())) 
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <div class="ml-2 d-flex flex-column">
                                <a href="{{ route('users.show',$user->id) }}" class="mb-0">{{ $user->name }}</a>
                            </div>
                            <a href="{{ route('users.show',$user->id) }}">詳細</a>
                            <form action="{{ route('unfollow',$user->id) }}" method="POST">
                            {{ csrf_field() }}
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">フォロー解除</button>
                            </form>
                           
                            @php
                                $a = 1
                            @endphp
                        </div>

                    </div>

                    @endif
                @endforeach

                @if(empty($a))
                        <h3>　・・・</h3>
                    @endif

                <h2>承認待ちです</h2>
                @foreach ($all_users  as $user)
                
                @if(in_array($user->id,Auth::user()->follow()))
                    @if(!in_array($user->id,Auth::user()->followed())) 
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <div class="ml-2 d-flex flex-column">
                            <a href="{{ route('users.show',$user->id) }}" class="mb-0">{{ $user->name }}</a>
                            </div>
                            <form action="{{ route('unfollow',$user->id) }}" method="POST">
                            {{ csrf_field() }}
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">フォロー解除</button>
                            </form>

                        
                            @php
                                $a = 1
                            @endphp
                        </div>
                    </div>
                    @endif
                @endif
                @endforeach

                @if(empty($a))
                        <h3>　・・・</h3>
                @endif

                <h2>フォローしていません</h2>
                @foreach ($all_users  as $user)
                @if(!in_array($user->id,Auth::user()->follow())) 
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            
                            <div class="ml-2 d-flex flex-column">
                            <a href="{{ route('users.show',$user->id) }}" class="mb-0">{{ $user->name }}</a>
                            </div>

                            <form action="{{ route('users.store') }}" method="POST">
                            {{ csrf_field() }}
                            @method('POST')
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="follow_id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-primary">フォロー</button>
                            </form>
                            
                        </div>
                    </div>
                    @php
                        $u = 1
                    @endphp

                    @endif

                @endforeach

                @if(empty($u))
                        <h3>　NO DATA</h3>
                @endif

                <h2>フォローされています</h2>
                @foreach ($all_users  as $user)
                @if(in_array($user->id,Auth::user()->followed())) 
                    @if(!in_array($user->id,Auth::user()->follow()))
                    
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <div class="ml-2 d-flex flex-column">
                            <a href="{{ route('users.show',$user->id) }}" class="mb-0">{{ $user->name }}</a>
                            </div>
                            <form action="{{ route('users.store') }}" method="POST">
                            {{ csrf_field() }}
                            @method('POST')
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="follow_id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-primary">フォロー</button>
                            </form>

                        
                            @php
                                $e = 1
                            @endphp
                        </div>
                    </div>
                    @endif
                @endif
                @endforeach

                @if(empty($e))
                        <h3>　・・・</h3>
                @endif


            </div>
        </div>
        <div class="my-4 d-flex justify-content-center">
            {{ $all_users->links() }}
        </div>
    </div>
@endsection

    
</body>