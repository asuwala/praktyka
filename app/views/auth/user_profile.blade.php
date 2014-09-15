@extends('layouts.dashboard')


@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Profil użytkownika {{Session::get('username', '')}}</h3>
    </div>
<div class="panel-body">
<form class="form-horizontal" role="form" method="POST" action="user-profile" accept-charset="UTF-8">
    <input name="_token" type="hidden" value="{{ Session::get('_token') }}">
    <input name="is_admin" type="hidden" value="{{$user->is_admin}}">
    <div class="form-group">
        <label for="inputEmail" class="col-sm-3 control-label">Adres email</label>
        <div class="col-sm-6">
            <input id="inputEmail" name="email" type="text" class="form-control" placeholder="Nazwa użytkownika" value="{{$user->email}}" disabled required>
        </div>    
    </div>
    <div class="form-group">
        <label for="inputUsername" class="col-sm-3 control-label">Nazwa użytkownika</label>
        <div class="col-sm-6">
            <input id="inputUsername" name="username" type="text" class="form-control" placeholder="Nazwa użytkownika" value="{{$user->username}}" required>
            @foreach ($errors->get('username') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
            @endforeach
        </div>
        
    </div>
    <div class="form-group">
        <label for="inputPassword" class="col-sm-3 control-label"></label>
        <div class="col-sm-6">
            <input id="inputPassword" name="password" type="password" class="form-control" placeholder="Hasło" required>
            @foreach ($errors->get('password') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
            @endforeach
            
        </div>
    </div>    
    <div class="form-group">
        <label for="inputNewPassword" class="col-sm-3 control-label"></label>
        <div class="col-sm-6">
            <input id="inputNewPassword" name="new_password" type="password" class="form-control" placeholder="Nowe hasło">
            @foreach ($errors->get('new_password') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
            @endforeach
            
        </div>
    </div>     
    <div class="form-group">
        <label for="inputNewPasswordConfirmation" class="col-sm-3 control-label"></label>
        <div class="col-sm-6">
            <input id="inputNewPasswordConfirmation" name="new_password_confirmation" type="password" class="form-control" placeholder="Potwierdź nowe hasło">
            @foreach ($errors->get('new_password_confirmation') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
            @endforeach
            
        </div>
    </div>
    <div class="form-group">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
    <div class="btn-group btn-group-justified">
        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Zapisz</button>
        </div>
        <a class="btn btn-primary" role="button" href="{{ URL::to('/') }}/auth/user-profile">Anuluj</a>
    </div>
    </div>
    </div>
</form>
</div>
</div>


@stop