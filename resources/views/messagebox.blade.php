<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メッセージ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
    
@extends('layouts.app')
@section('content')

@if ($checkCount == 0)
    新着メッセージはありません
@else
    新着メッセージが{{ $checkCount }}件あります
@endif

    
    @foreach($s as $message)
        @if ($message->check == 0)
            <div style="color: yellow;">新着メッセージです</div>
        @endif


        @foreach($mainlists as $mainlist)
            @if( $message->mainlist_id == $mainlist->id)
                <p>タイトル:{{ $mainlist->content }}</p>
            @endif
        @endforeach

        @foreach($users as $messenger)
            @if( $message->send_id == $messenger->id)
                <p>送信者:{{ $messenger->name }}</p>
            @endif
        @endforeach

        <p> {{ $message->message }}</p>
        <p> {{ $message->created_at }}</p>
        <a href="{{ route('chat',$message->chat_id) }}">返信する</a>
    @endforeach

    
    


                  
@endsection
</body>

</html>