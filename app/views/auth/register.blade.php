@extends('layouts.base')

@section('content')
<!--
@if(Session::has('message'))

    @if(Session::has('mtype'))
        @if(Session::get('mtype')==='danger')
            <div class="alert alert-danger">{{ Session::get('message') }}</div>
        @elseif(Session::get('mtype')==='warning')
            <div class="alert alert-warning">{{ Session::get('message') }}</div>
        @elseif(Session::get('mtype')==='success')
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @else
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
    @endif
@endif

-->
<div class="panel panel-primary">
        <div class="panel-heading">
        <h3 class="panel-title">Rejestracja</h3>
    </div>
<div class="panel-body">
<form method="POST" action="register" accept-charset="UTF-8" class="form-register">
    <input name="_token" type="hidden" value="{{ csrf_token() }}">
    <input name="is_admin" type="hidden" value="false">
    <div class="form-group">
        <input name="email" type="email" class="form-control" placeholder="Adres e-mail" value="{{ Input::old('email') }}" required autofocus>
        @foreach ($errors->get('email') as $msg)
            <div class="alert alert-danger">{{ $msg }}</div>
        @endforeach
    </div>
    <div class="form-group">
        <input name="username" type="text" class="form-control" placeholder="Nazwa użytkownika" value="{{ Input::old('username') }}" required>
        @foreach ($errors->get('username') as $msg)
            <div class="alert alert-danger">{{ $msg }}</div>
        @endforeach
    </div>
    <div class="form-group">
        <input name="password" type="password" class="form-control" placeholder="Hasło" required>
        @foreach ($errors->get('password') as $msg)
            <div class="alert alert-danger">{{ $msg }}</div>
        @endforeach
    </div>
    <div class="form-group">
        <input name="password_confirmation" type="password" class="form-control" placeholder="Powtórz hasło" required>
        @foreach ($errors->get('password_confirmation') as $msg)
            <div class="alert alert-danger">{{ $msg }}</div>
        @endforeach
    </div>
    <button type="submit" class="btn btn-primary btn-block">Zarejestruj</button>
</form>
</div>
</div>
@stop