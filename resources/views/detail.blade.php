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
    

    @if (session('message'))
        <span>{{ (session('message')) }}</span>
    @endif

    <div class="detail-body">
    <dl>
        <dt>投稿者</dt>
        <dd><a href="{{ route('users.show', $mainlists->user_id) }}">{{  $mainlists->user->name }}</a></dd>
    </dl>

    <dl>
        <dt>やらないこと</dt>
        <dd>{{  $mainlists->content }}</dd>
    </dl>

    <dl>
        <dt>解決策</dt>
        <dd>{{  $mainlists->solution }}</dd>
    </dl>
    
    <dl>
        <dt>更新日</dt>
        <dd>
            @php
                $update = $mainlists->updated_at;
                echo date("Y.n.j G:i",strtotime($update));
            @endphp
       
        </dd>
    </dl>

    <dl>
        <dt>作成日</dt>
        <dd>
            @php
                $create = $mainlists->updated_at;
                echo date("Y.n.j G:i",strtotime($create));
            @endphp
       
        </dd>
    </dl>

    @if ( Auth::id() == $mainlists->user_id  )
        <a href="{{route('edit', $mainlists->id) }}">編集</a>

    @else
        メッセージを送信できます
        <form action="{{ route('sendMessage') }}" method="POST">
        {{ csrf_field() }}
            @method('POST')
                <textarea class="form-contorl" name="message"></textarea>
                @if ($errors->has('message'))
                <div class="alert alert-danger mt-3">
                        @foreach ($errors->get('message') as $error)
                            {{ $error }}
                        @endforeach
                </div>
                 @endif

                <input type="hidden" name="sendId" value="{{ Auth::id() }}">
                @if ($errors->has('sendId'))
                <div class="alert alert-danger mt-3">
                        @foreach ($errors->get('sendId') as $error)
                            {{ $error }}
                        @endforeach
                </div>
                 @endif
                <input type="hidden" name="getId" value="{{ $mainlists->user_id }}">
                <input type="hidden" name="mainlistsId" value="{{ $mainlists->id }}">
                <button type="submit">送信</button>
        
        </form>
    @endif
    @if (session('sendMessage'))
        <span>{{ (session('sendMessage')) }}</span>
    @endif


    </div>

@endsection
</body>
</html>