<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チャット</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
    
@extends('layouts.app')
@section('content')

    <h2>[{{ $content->content }}]　{{ $send_user->name }}</h2>
    
    @foreach($chats as $chat)
        @if($chat->send_id == Auth::id())
            <div class="myMessage">
                {{ $chat->message }}
            </div>
        @else
            <div class="opponentMessage" style="color:red;">
                {{ $chat->message }}
            </div>
        @endif

    @endforeach

    <form action="{{ route('reply') }}" method="POST">
        {{ csrf_field() }}
            @method('POST')
                <textarea class="form-contorl" name="message"></textarea>

                <input type="hidden" name="getId" value="{{ $my_chat->send_id }}">
                <input type="hidden" name="sendId" value="{{ $my_chat->get_id }}">
                <input type="hidden" name="mainlistsId" value="{{ $my_chat->mainlist_id }}">
                <input type="hidden" name="chatId" value="{{ $my_chat->chat_id }}">
                
                <button type="submit">送信</button>

                @if ($errors->has('message'))
                <div class="alert alert-danger mt-3">
                        @foreach ($errors->get('message') as $error)
                            {{ $error }}
                        @endforeach
                </div>
                 @endif
        
        </form>                
@endsection
</body>

</html>