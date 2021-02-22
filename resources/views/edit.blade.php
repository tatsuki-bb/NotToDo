<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>リスト編集画面</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

    <div class="return">
    <a href="{{ route('post.show',$mainlists->id) }}"><div class="arrow"></div></a>
    <a href="{{ route('post.show',$mainlists->id) }}">戻る</a>
    </div>

    <div class="form-area">
    <form action="{{ route('post.update', $mainlists->id) }}" method="post">
    
        {{ csrf_field() }}
        @method('PUT')
        

        <dl>
            <dt><label for="content">やらないこと</label></dt>
            <dd><input type="text" id="content" class="form-design" name="content" value='{{  $mainlists->content }}' size="28"></dd>
        </dl>       
                @if ($errors->has('content'))
                <div class="alert alert-danger mt-3">
                        @foreach ($errors->get('content') as $error)
                            {{ $error }}
                        @endforeach
                </div>
                 @endif

        <dl>
            <dt><label for="InputSolution">解決策</label></dt>
            <dd><textarea name="solution" id="InputSolution" class="form-design" cols="30" rows="10">{{  $mainlists->solution }}</textarea></dd>
        </dl>
            @if ($errors->has('solution'))
                <div class="alert alert-danger mt-3">
                        @foreach ($errors->get('solution') as $error)
                            {{ $error }}
                        @endforeach
                </div>
                 @endif

            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                 @if ($errors->has('user_id'))
                <div class="alert alert-danger mt-3">
                    @foreach ($errors->get('user_id') as $error)
                        {{ $error }}
                    @endforeach
                </div>
                @endif

        

        <button type="submit" class="registration-btn">更新</button>

        
    </form>
    <form style="display:inline" action="{{ route('post.update', $mainlists->id) }}" method="post">
            {{ csrf_field() }}
            @method('DELETE')
            <button type="submit" class="delete-btn">削除</button>
    </form>
    
    </div>
</body>
</html>