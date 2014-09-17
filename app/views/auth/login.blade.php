@extends('layouts.base')

@section('content')
<div class="panel panel-primary panel">
        <div class="panel-heading">
        <h3 class="panel-title">Logowanie</h3>
    </div>
<div class="panel-body">
<form method="POST" action="login" accept-charset="UTF-8" class="form-login">
    <input name="_token" type="hidden" value="{{ csrf_token() }}">
    @foreach ($errors->get('error') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
    @endforeach
    <div class="form-group">
    <input name="email" type="email" class="form-control" placeholder="Adres e-mail" required autofocus>
    </div>
    <div class="form-group">
    <input name="password" type="password" class="form-control" placeholder="Hasło" required>
    </div>
    <div class="checkbox">
        <label><input name="remember_me" type="checkbox" value="0" id="remember_me">Zapamiętaj mnie</label>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Zaloguj</button>
</form>
</div>
</div>
@stop