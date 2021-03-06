<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark-custom fixed-top">
        <div class="container">
            <a class="navbar-brand mr-5" href="{{ url('/') }}">
                <img src="{{URL::asset('/img/logo.png')}}" alt="Uniled logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                @if (!Auth::guest())
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ Request::is('feed/*')?'active':'' }}">
                            <a href="/feed/browse" class="nav-link" id="feed_browse">
                                Feed
                            </a>
                        </li>
                        @if (Auth::user()->Role->code === 'admin')
                            <li class="nav-item {{ Request::is('company/*')?'active':'' }}">
                                <a href="/company/browse" class="nav-link" id="company_browse">
                                    Companies
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('user/*')?'active':'' }}">
                                <a href="/user/browse" class="nav-link" id="company_browse">
                                    Users
                                </a>
                            </li>
                        @endif
                        <li class="nav-item {{ Request::is('images/*')?'active':'' }}">
                            <a href="/images/browse" class="nav-link" id="images_browse">
                                Images
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                @endif
            </div>

        </div>
    </nav>

    @if(session()->has('message'))
        <div class="alert alert-{{ session()->get('type') }}">
            <span class="msg"> {{ session('message') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="pt-5">
    @yield('content')
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</body>
</html>
