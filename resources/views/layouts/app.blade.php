<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>JOIN</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
   

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <a class="navbar-brand" href="{{ route('home') }}">
                    MENU
                </a>
                


                    <!-- Right Side Of Navbar -->
                    <ul>
                        <!-- Authentication Links -->
                        @guest　　<!-- ログインしていないとき -->
                            @if (Route::has('login'))
                                <li>
                                    <a href="{{ route('login') }}">ログイン</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}">登録</a>
                                </li>
                            @endif

                         @else
                        
                                <li>
                                    <a href="{{ route('post.create') }}">投稿する</a>
                                </li>
                            
                                @if(!Route::is('myList'))
                                <li>
                                    <a href="{{ route('myList',Auth::id())}}">マイリスト</a>
                                </li>
                                @endif
                                
                                @if(!Route::is('posts,index'))
                                <li>
                                    <a href="{{ route('posts,index') }}">タイムライン</a>
                                </li>
                                @endif
                                
                                <li>
                                    <a href="#">メッセージ</a>
                                </li>

                                @if(!Route::is('users.index'))
                                <li>
                                    <a href="{{ route('users.index')}}">フォロワー</a>
                                </li>
                                @endif
                                
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    ログアウト
                                    </a>
                                </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            

                        @endguest
                    </ul>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
</body>
</html>
