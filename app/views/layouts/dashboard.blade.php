@extends('layouts.base')

@section('head')
<!-- Place inside the <head> of your HTML -->
<script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
@stop

@section('menu-content')
    <a href="{{URL::to('/')}}" class="list-group-item active">Panel użytkownika</a>
    <a href="{{ url('auth/user-profile') }}" class="list-group-item">Profil</a>
    <a href="{{ url('auth/user-profile') }}" class="list-group-item">Ulubione artykuły</a>
    @if(Session::get('admin'))
        <a href="{{ url('articles/manage-panel') }}" class="list-group-item">Zarządzaj artykułami</a>
        <a href="{{ url('subcategories/manage-panel') }}" class="list-group-item">Zarządzaj podkategoriami</a>
    @endif
@stop

@section('content')

@stop