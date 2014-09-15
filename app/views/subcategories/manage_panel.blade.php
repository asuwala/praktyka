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
    <h3 class="panel-title">Panel zarządzania podkategoriami</h3>
  </div>
  <div class="panel-body">
        <select name="selected_category" id="selected_category" class="form-control" onchange="getSubcategoriesList();">
            <option value="" selected="selected">Wybierz kategorię główną..</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

  <!-- <div class="panel-body">
    <p>...</p>
  </div> -->
    <hr></hr>
  <!-- List group -->
  <ul id="subcategories-list-group" class="list-group">
      <div class="list-group-item active">
        <h4 class="list-group-item-heading">Lista podkategorii</h4>
    </div>
  </ul>
  <hr></hr>
  <a class="btn btn-primary pull-right" role="button" href="{{ url('subcategories/create') }}">Dodaj nową podkategorię</a>
  </div>
</div>

@stop

