@extends('layouts.dashboard')


@section('content')
<div class="panel panel-primary">
  <!-- Default panel contents -->

      <div class="panel-heading">
        <h3 class="panel-title">Utwórz nową podkategorię</h3>
      </div>
  <div class="panel-body">
<form method="POST" action="create" accept-charset="UTF-8">
            <br>
    <div class="form-group">
        <input name="name" type="text" class="form-control" placeholder="Nazwa" required autofocus>
        @foreach ($errors->get('name') as $message)
           <div class="alert alert-danger" role="alert">{{ $message }}</div>
        @endforeach
    </div>

    <div class="form-group">
        <input name="description" type="text" class="form-control" placeholder="Opis (opcjonalny)">
        @foreach ($errors->get('description') as $message)
            <div class="alert alert-danger" role="alert">{{ $message }}</div>
        @endforeach
    </div>
    <div class="form-group">
        <select name="selected_category" class="form-control" required>
            <option value="" selected="selected">Wybierz kategorię główną..</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <hr>
    <div class="btn-group btn-group-justified">
        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Zapisz</button>
        </div>
        <a class="btn btn-primary" role="button" href="{{ URL::previous() }}">Anuluj</a>
    </div>
    <!-- <button type="submit" class="btn btn-primary btn-block">Zapisz</button> -->
</form>
      
  </div>
    </div>
@stop
