@extends('layouts.dashboard')

<!-- File: views/subcategories/edit.blade.php -->
@section('content')
<div class="panel panel-primary">
  <!-- Default panel contents -->

      <div class="panel-heading">
        <h3 class="panel-title">Edytuj podkategorię</h3>
      </div>
  <div class="panel-body">
<form method="POST" action="edit" accept-charset="UTF-8" >
            <br>
    <input name="_subcategory_id" type="hidden" value="{{ $subcategory->id }}">
    <div class="form-group">
        <input id="subcategory-name" name="name" type="text" class="form-control" placeholder="Nazwa" value="{{ $subcategory->name }}">
        @if ($errors->has('name'))
            @foreach ($errors->get('name') as $message)
                <div class="alert alert-danger">{{ $message }}</div>
            @endforeach
        @endif
    </div>

    <div class="form-group">
        <input name="description" type="text" class="form-control" placeholder="Opis (opcjonalny)" value="{{ $subcategory->description }}">
        @if ($errors->has('description'))
            @foreach ($errors->get('description') as $message)
                <div class="alert alert-danger">{{ $message }}</div>
            @endforeach
        @endif
    </div>
    <div class="form-group">
        <select name="selected_category" class="form-control" required>
            @foreach ($categories as $category)
                @if ($category->id==$category_id)
                    <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
                @else
                    <option value="{{$category->id}}">{{ $category->name }}</option>
                @endif
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
</form>
        </div>
      </div>
@stop
