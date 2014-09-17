@extends('layouts.dashboard')

@section('head')
<!-- Place inside the <head> of your HTML -->
<script type="text/javascript" src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/appelfinder.js') }}"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea#mceEditor",
        relative_urls: false,
        setup: function (editor) {
            editor.on('change', function () {
                //console.log("before triggerSave()");
                tinymce.triggerSave();
                //console.log("after triggerSave()");
                //console.log("Zawartość: " + $('#mceEditor').val());
            });
        },   
        theme: "modern",
        height: 300,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        content_css: "{{ asset('css/bootstrap.min.css') }}",
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],
        file_browser_callback : elFinderBrowser
    });


</script>

@stop

@section('content')
<!--
@foreach ($errors->all() as $msg)
     <div class="alert alert-info" role="alert">{{ $msg }}</div>
@endforeach
-->
<div class="panel panel-primary">
  <!-- Default panel contents -->

      <div class="panel-heading">
        <h3 class="panel-title">Utwórz nowy artykuł</h3>
      </div>
  <div class="panel-body">
<form method="POST" action="create" accept-charset="UTF-8">
    <div class="form-group">
        <input id="title" name="title" type="text" class="form-control" placeholder="Tytuł" value="{{ Input::old('title') }}" required>
        @foreach ($errors->get('title') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
        @endforeach

    </div>

    <div class="form-group">
        <input id="author" name="author" type="text" class="form-control" placeholder="Autor" value="{{ Input::old('author') }}" required>
            @foreach ($errors->get('author') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
            @endforeach
    </div>

    <div class="form-group">
        <select name="selected_category" id="selected_category" class="form-control" onchange="updateSubcategoriesList();" required>
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
            <select name="selected_subcategory" id="selected_subcategory" class="form-control" required>
             <option value="" selected="selected">Wybierz podkategorię..</option>
        </select>
            @foreach ($errors->get('selected_subcategory') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
            @endforeach
        

    </div>
    <div class="form-group">
        <textarea id="mceEditor" name="contents" onload="populateEditorContent();">{{ Input::old('contents') }}</textarea>
            @foreach ($errors->get('contents') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
            @endforeach
        
    </div>
    <div class="btn-group btn-group-justified">
        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Zapisz</button>
        </div>
        <a class="btn btn-primary" role="button" href="{{ URL::previous() }}">Anuluj</a>
    </div>

    <!--
    <button type="button" onclick="saveArticle();" class="btn btn-primary btn-block">Zapisz</button>
     -->
</form>
            
  </div>
    </div>
@stop
