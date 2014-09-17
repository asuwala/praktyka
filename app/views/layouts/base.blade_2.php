<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-type" value="text/html; charset=UTF-8" />
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Praktyka</title>

        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/blog.css') }}" />
        <!--
        {{ HTML::style('plugins/bootstrap/css/bootstrap.css'); }}
        {{ HTML::style('css/main.css'); }}
                <script type="text/javascript" src="{{ asset('js/angular.js') }}" async></script>
        <script type="text/javascript" src="{{ asset('js/ui-bootstrap-tpls-0.11.0.js') }}" async></script>
        -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!--<script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script> -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/apps.js') }}"></script>
      <!--  <script type="text/javascript" src="{{ asset('js/articles.js') }}"></script> -->
        <!-- Place inside the <head> of your HTML -->


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        @yield('head')
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">Project name</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/') }}">Strona główna</a></li>
                        <li><a href="{{ url('about') }}">O nas</a></li>
                        <li><a href="{{ url('contact') }}">Kontakt</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        
                        @if(!Auth::check())
                        <li><a href="{{ url('auth/login') }}">Logowanie</a></li>
                        <li><a href="{{ url('auth/register') }}">Rejestracja</a></li>
                        @else
                        <li><a href="{{ url('auth/user-profile') }}">Panel użytkownika</a></li>
                        <li><a href="{{ url('auth/logout') }}">Wyloguj</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row row-offcanvas row-offcanvas-right content">
                <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                    <div id="menu-list" class="list-group">
                        @yield('menu-content')
                    </div>
                </div><!--/span-->
                <div class="col-xs-12 col-sm-9">
                    <p class="pull-right visible-xs">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                    </p>
              <!--      <div class="jumbotron"> -->
                        
                        
                        @if(Session::has('message'))
                            @if(Session::has('mtype'))
                                @if(Session::get('mtype')==='danger')
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Zamknij</span>
                                    </button>
                                    {{ Session::get('message') }}
                                </div>
                                @elseif(Session::get('mtype')==='warning')
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Zamknij</span>
                                    </button>
                                    {{ Session::get('message') }}
                                </div>
                                @elseif(Session::get('mtype')==='success')
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Zamknij</span>
                                    </button>
                                    {{ Session::get('message') }}
                                </div>
                                @else
                                <div class="alert alert-info alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Zamknij</span>
                                </button>
                                {{ Session::get('message') }}
                                </div>
                                @endif
                            @else
                            <div class="alert alert-info alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Zamknij</span>
                                </button>
                                {{ Session::get('message') }}
                            </div>
                            @endif
                        @endif
                        @yield('content')
               <!--     </div><!--/jumbotron-->
                </div><!--/span-->
            </div><!--/row-->
            <hr></hr>
            <footer>
                <p>Project Name 2014</p>
            </footer>
        </div><!-- /.container -->
        @yield('body')
    </body>
</html>
