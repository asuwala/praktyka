@extends('layouts.dashboard')

@section('content')
<!--<ul class="errors">
    @foreach($errors->all() as $message)
    <li class="alert alert-danger">{{ $message }}</li>
    @endforeach
</ul>
-->

<div class="panel panel-primary">
  <!-- Default panel contents -->

  <div class="panel-heading">
    <h3 class="panel-title">Usuwanie podkategorii</h3>
  </div>
  <div class="panel-body">
  <form method="POST" action="remove" accept-charset="UTF-8" >
      <div class="alert alert-danger" role="alert">{{ $warning_message }}</div>
      <button type="submit" class="btn btn-primary">Usuń podkategorię razem z artykułami</button>
      <a class="btn btn-primary" role="button" href="{{ URL::previous() }}">Anuluj</a>
  </div>
  <!--
  <div class="btn-group btn-group-justified">
        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Usuń podkategorię razem z artykułami</button>
        </div>
        <a class="btn btn-primary" role="button" href="{{ URL::to('/') }}/subcategories/manage-panel">Anuluj</a>
    </div>
  -->

</form>
</div>

@stop

