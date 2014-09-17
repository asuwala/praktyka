@extends('layouts.base')

@section('head')
<!-- Place inside the <head> of your HTML -->
<script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
@stop

@section('menu-content')
    <a href="{{URL::to('/')}}" class="list-group-item active">Panel użytkownika</a>
    <a href="{{ url('auth/user-profile') }}" class="list-group-item">Profil</a>
<!--    <a href="{{ url('auth/user-profile') }}" class="list-group-item">Ulubione artykuły</a> -->
    @if(Session::get('admin'))
        <a href="{{ url('articles/manage-panel') }}" class="list-group-item">Zarządzaj artykułami</a>
        <a href="{{ url('subcategories/manage-panel') }}" class="list-group-item">Zarządzaj podkategoriami</a>
    @endif
@stop

@section('content')
<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
    <div id="menu-list" class="list-group">
        <a href="{{URL::to('/')}}" class="list-group-item active">Panel użytkownika</a>
        <a href="{{ url('auth/user-profile') }}" class="list-group-item">Profil</a>
<!--    <a href="{{ url('auth/user-profile') }}" class="list-group-item">Ulubione artykuły</a> -->
        @if(Session::get('admin'))
        <a href="{{ url('articles/manage-panel') }}" class="list-group-item">Zarządzaj artykułami</a>
        <a href="{{ url('subcategories/manage-panel') }}" class="list-group-item">Zarządzaj podkategoriami</a>
        @endif
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
@stop