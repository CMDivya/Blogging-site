@extends('layouts.app')
@section('content')
    <body>
    <h1 style='align:center';>Welcome To The Blogging World</h1>
        <div class="flex-center position-ref full-height">
          <!--  @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                    <a href="{{ route('login') }}">Login</a>

                       @if (Route::has('register'))
   <div class="dropdown">
  <li class="nav item-dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">REGISTER</a>
  <div class="dropdown-content">
    <a href="{{ route('Admin') }}" name="type" value="Admin">Admin</a>
    <a href="{{ route('register') }}" name ="type" value="User">Other User</a>
  </div>-->
</div>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
@endsection
