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

<h1>メッセージ一覧</h1>

@if ($checkCount == 0)
    <div class="not-read-message">新着メッセージはありません</div>
@else
    <div class="read-message">新着メッセージが{{ $checkCount }}件あります</div>
@endif

<table>
        <tr>
            <th>check</th>
            <th>send</th>
            <th>NotToDo</th>
            <th>reply</th>
        </tr>
        @foreach($s as $message)
        <tr>
            <td>
                @if ($message->check == 0)
                    <div style="color: red;">新着</div>

                @else
                    　済
                @endif
            </td>
            <td>
                @foreach($users as $messenger)
                    @if( $message->send_id == $messenger->id)
                        {{ $messenger->name }}
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($mainlists as $mainlist)
                    @if( $message->mainlist_id == $mainlist->id)
                        {{ $mainlist->content }}
                    @endif
                @endforeach

            </td>
            <td>
                <a href="{{ route('chat',$message->chat_id) }}">返信する</a>    
            </td>
        </tr>
        @endforeach
    
    </table>

    
    <!-- @foreach($s as $message)
        @if ($message->check == 0)
            <div style="color: yellow;">new</div>

        @else
            ✓
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
    @endforeach -->
    
                  
@endsection
</body>

</html>