@extends('layouts.base')

@section('content')
<ul class="errors">
    @foreach($errors->all() as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>
<form method="POST" action="register" accept-charset="UTF-8" class="form-register">
    <h2>Rejestracja</h2>
    <input name="_token" type="hidden" value="{{ csrf_token() }}">
    <input name="is_admin" type="hidden" value="false">
    <div class="form-group">
        <input name="firstname" type="text" class="form-control" placeholder="Imię">
    </div>
    <div class="form-group">
        <input name="email" type="email" class="form-control" placeholder="Adres e-mail">
    </div>
    <div class="form-group">
        <input name="password" type="password" class="form-control" placeholder="Hasło">
    </div>
    <div class="form-group">
        <input name="password_confirmation" type="password" class="form-control" placeholder="Powtórz hasło">
    </div>
    <button type="submit" class="btn btn-lg btn-primary">Zarejestruj</button>
</form>
@stop