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
<div class="box-title">{{ $content->content }}　{{ $send_user->name }}</div>

<div class="Message-box">
    
    @foreach($chats as $chat)
                @if($chat->send_id == Auth::id())
                <div class="bms_message bms_right">
                    <div class="bms_message_box">
                        <div class="bms_message_content">
                            <div class="bms_message_text">{{ $chat->message }}</div>
                        </div>
                    </div>
                </div>
                <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->                
                @else
                <div class="bms_message bms_left">
                    <div class="bms_message_box">
                        <div class="bms_message_content">
                            <div class="bms_message_text">{{ $chat->message }}</div>
                        </div>
                    </div>
                </div>
                <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->
                @endif

    @endforeach



    <form action="{{ route('reply') }}" method="POST">
            {{ csrf_field() }}
            @method('POST')
                <div id="bms_send"> 
                    <textarea name="message" id="bms_send_message"></textarea>

                    <input type="hidden" name="getId" value="{{ $my_chat->send_id }}">
                    <input type="hidden" name="sendId" value="{{ $my_chat->get_id }}">
                    <input type="hidden" name="mainlistsId" value="{{ $my_chat->mainlist_id }}">
                    <input type="hidden" name="chatId" value="{{ $my_chat->chat_id }}">
                    
                    <button type="submit" id="bms_send_btn">送信</button>

                    @if ($errors->has('message'))
                    <div class="alert alert-danger mt-3">
                            @foreach ($errors->get('message') as $error)
                                {{ $error }}
                            @endforeach
                    </div>
                    @endif
                </div>
    </form>  

    </div>
</div>
<form action="{{ route('reply') }}" method="POST">
            {{ csrf_field() }}
            @method('POST')
                <div id="bms_send"> 
                    <textarea name="message" id="bms_send_message"></textarea>

                    <input type="hidden" name="getId" value="{{ $my_chat->send_id }}">
                    <input type="hidden" name="sendId" value="{{ $my_chat->get_id }}">
                    <input type="hidden" name="mainlistsId" value="{{ $my_chat->mainlist_id }}">
                    <input type="hidden" name="chatId" value="{{ $my_chat->chat_id }}">
                    
                    <button type="submit" id="bms_send_btn">送信</button>

                    @if ($errors->has('message'))
                    <div class="alert alert-danger mt-3">
                            @foreach ($errors->get('message') as $error)
                                {{ $error }}
                            @endforeach
                    </div>
                    @endif
                </div>
</form>
@endsection
</body>

</html>