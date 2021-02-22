<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タイムライン</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
@extends('layouts.app')
@section('content')

@if (session('message'))
    <span>{{ (session('message')) }}</span>
@endif

@if (session('registration'))
    <span>{{ (session('registration')) }}</span>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <div class="page-title">
        <h1>タイムライン</h1>
        </div>
            

                
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($mainlists as $list) 
                    <div class="card">
                    <div class="card-body">
                       
                            <div class="card-head">
                                <a href="{{ route('users.show',$list->user_id) }}">{{ $list->user->name }}</a>
                                <div>
                                @php
                                    $update = $list -> updated_at;
                                    echo date("Y.n.j G:i",strtotime($update));
                                @endphp
                                </div>
                            </div>
                            <div class="card-main">
                                <div>{{ $list -> content }}</div>
                            </div>
                            <div class="card-foot">
                                <a href="{{ route('post.show',$list->id) }}">詳細</a>
                                <!-- <div>
                                @if ( Auth::id() == $list -> user -> id  )
                                    your list!!
                                @endif
                                </div> -->
                            </div>

                        
                    </div>
                    </div>
                    @endforeach

                    
                  
                
            
        </div>
    </div>
    <div class="pagination">
        {{ $mainlists->links('pagination::bootstrap-4') }}    
    </div>
    
</div>
<!-- <a href="/post/create">リスト登録</a> -->
@endsection
</body>
</html>

