@extends('layouts.base')

@section('content')
<p> Witaj {{ Session::get('username', '') }}!</p>
@stop