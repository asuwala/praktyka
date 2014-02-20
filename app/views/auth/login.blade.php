@extends('layouts.base')

@section('content')

<form method="POST" action="login" accept-charset="UTF-8" class="form-login">
    <input name="_token" type="hidden" value="{{ csrf_token() }}">
    <h2>Logowanie</h2>
        <input name="email" type="email" class="form-control" placeholder="Adres e-mail">
        <input name="password" type="password" class="form-control" placeholder="Hasło">
    <div class="checkbox">
    <label>
      <input name="remember_me"
           type="checkbox"
           value="0"
           id="remember_me">Zapamiętaj mnie
    </label>
  </div>
    <button type="submit" class="btn btn-lg btn-primary">Zaloguj</button>
</form>
@stop