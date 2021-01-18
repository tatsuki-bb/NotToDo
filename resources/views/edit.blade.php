<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>リスト編集画面</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
    <a href="{{ route('post.show',$mainlists->id) }}">戻る</a>

    <form action="{{ route('post.update', $mainlists->id) }}" method="post">
    
        {{ csrf_field() }}
        @method('PUT')
        <div class="form-group">

            <label for="content">やらないこと</label>    
            <input type="text" id="content"　 class="form-control" name="content" value='{{  $mainlists->content }}'>
               
                @if ($errors->has('content'))
                <div class="alert alert-danger mt-3">
                        @foreach ($errors->get('content') as $error)
                            {{ $error }}
                        @endforeach
                </div>
                 @endif

            <label for="InputSolution">解決策</label>
            <textarea class="form-contorl" name="solution" id="InputSolution"　class="form-control" cols="30" rows="10">{{  $mainlists->solution }}</textarea>
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

        </div>

     
        <button type="submit" class="btn btn-primary">更新</button>

        </div>
    </form>

    <!-- <a href="#">削除</a> -->

    <form style="display:inline" action="{{ route('post.update', $mainlists->id) }}" method="post">
        {{ csrf_field() }}
        @method('DELETE')
        <button type="submit" class="btn btn-danger">削除</button>

    </form>
</body>
</html>