@extends('layouts.dashboard')


@section('content')
<div class="panel panel-primary">
  <!-- Default panel contents -->

  <div class="panel-heading">
    <h3 class="panel-title">Panel zarządzania artykułami</h3>
  </div>
  <div class="panel-body">
      <div class="form-group">        
        <select name="selected_category" id="selected_category" class="form-control" onchange="updateArtSubcList();" required>
            <option value="" selected="selected">Wybierz kategorię główną..</option>
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{ $category->name }}</option>
            @endforeach
        </select>
          @foreach ($errors->get('selected_category') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
          @endforeach
    </div>
        <div class="form-group">
            
        <select name="selected_subcategory" id="selected_subcategory" class="form-control" onchange="getArticlesList();">
             <option value="" selected="selected">Wybierz podkategorię..</option>
        </select>
            @foreach ($errors->get('selected_subcategory') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
            @endforeach

    </div>


  <!-- <div class="panel-body">
    <p>...</p>
  </div> -->

  <!-- List group -->
  <hr></hr>
  <ul id="articles-list-group" class="list-group">
      <div class="list-group-item active">
        <h4 class="list-group-item-heading">Lista artykułów</h4>
    </div>
  </ul>
  <hr></hr>
  <a class="btn btn-primary pull-right" role="button" href="{{ url('articles/create') }}">Dodaj nowy artykuł</a>
  </div>
</div>

@stop

