<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>
            @section('title')
            Praktyka
            @show
        </title>

        <!-- Bootstrap -->
        <link href="{{ URL::asset('packages/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/main.css') }}" rel="stylesheet">

        @yield('head')
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>Miejsce na logo lub napis</h1>
            </div>
        </div>
        <!-- Navbar -->
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">

                    <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <a class="brand" href="{{ url('/') }}">Strona główna</a>

                    <!-- Everything you want hidden at 940px or less, place within here -->
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            @if(!Auth::check())
                            <li><a href="{{ url('auth/login') }}">Logowanie</a></li>
                            <li><a href="{{ url('auth/register') }}">Rejestracja</a></li>
                            @else
                            <li><a href="{{ url('auth/dashboard') }}">Panel użytkownika</a></li>
                            <li><a href="{{ url('auth/logout') }}">Wyloguj</a></li>
                            @endif
                        </ul> 
                    </div>
                </div>
            </div>
        </div> 

        <!-- Container -->
        <div class="container">
            @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
            @endif

            <!-- Content -->
            @yield('content')


        </div>

        @yield('body')

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="packages/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
