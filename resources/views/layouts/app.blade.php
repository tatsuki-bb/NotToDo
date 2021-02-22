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
       

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <header class="page-header">
      
                <!-- <a href="{{ route('home') }}">
                    MENU
                </a> -->

            <h1>やらないことリスト</h1>

            <nav>
                <!-- Right Side Of Navbar -->
                    <ul class="main-nav">
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
                        
                                @if(!Route::is('post.create'))
                                <li>
                                    <a href="{{ route('post.create') }}">投稿する</a>
                                </li>
                                @endif

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
                                
                                @if(!Route::is('messagebox'))
                                <li>
                                    <a href="{{ route('messagebox',Auth::id()) }}">メッセージ</a>
                                    @if (!$checkCount == 0) 
                                        <span style="color: yellow;">new✉</span>
                                    @endif
                                </li>
                                @endif

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

    </header>

    <main class="main">
        @yield('content')
        <div class="menu-guide">
            <span class="toukou-guide">投稿する</span>
            <span class="timeline-guide">タイムライン</span>
            <span class="message-guide">メッセージ</span>
            <span class="follower-guide">フォロワー</span>
            <span class="logout-guide">ログアウト</span>
        </div>

    </main>

    <footer class="footer-page">
        <nav>
            <ul class="main-nav">
                
                @guest　　
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
                
                        @if(!Route::is('post.create'))
                        <li class="toukou-icon">
                            <a href="{{ route('post.create') }}"><img src="{{ asset('images/toukou.png') }}" alt=""></a>
                        </li>
                        @endif

                        @if(!Route::is('myList'))
                        <li class="mylist-icon">
                            <a href="{{ route('myList',Auth::id())}}"><img src="{{ asset('images/mylist.png') }}" alt=""></a>
                        </li>
                        @endif
                        
                        @if(!Route::is('posts,index'))
                        <li class="timeline-icon">
                            <a href="{{ route('posts,index') }}"><img src="{{ asset('images/timeline.png') }}" alt=""></a>
                        </li>
                        @endif
                        
                        @if(!Route::is('messagebox'))
                        <li class="message-icon">
                            <a href="{{ route('messagebox',Auth::id()) }}"><img src="{{ asset('images/mail.png') }}" alt=""></a>
                            @if (!$checkCount == 0) 
                                <span style="color: yellow;">new✉</span>
                            @endif
                        </li>
                        @endif

                        @if(!Route::is('users.index'))
                        <li>
                            <a class="follower-icon" href="{{ route('users.index')}}"><img src="{{ asset('images/follower.png') }}" alt=""></a>
                        </li>
                        @endif
                        
                        <li class="logout-icon">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <img src="{{ asset('images/logout.png') }}" alt="">
                            </a>
                        </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                    

                @endguest

        
            </ul>

        </nav>

    </footer>
</body>
</html>
