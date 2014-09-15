@extends('layouts.base')

@section('head')
<!-- Place inside the <head> of your HTML -->
<script type="text/javascript" src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/appelfinder.js') }}"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea#mceEditor",
        theme: "modern",
        height: 300,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        content_css: "{{ asset('plugins/bootstrap/css/bootstrap.css') }}",
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
@foreach ($categories as $category)
<p>Kategoria: {{ $category->name }}</p>
@foreach ($category->subcategories() as $sub)
<li>$sub->name</li>
@endforeach
@endforeach
--
<form method="POST" action="create" accept-charset="UTF-8">
-->
<!-- <form method="POST" onsubmit="" accept-charset="UTF-8"> -->
    <h3>Utwórz nowy artykuł</h3><br>
    <div class="form-group">
        <input id="title" name="title" type="text" class="form-control" placeholder="Tytuł" required>
        @if ($errors->has('title'))
            @foreach ($errors->get('title') as $message)
                <div class="alert alert-danger">{{ $message }}</div>
            @endforeach
        @endif
    </div>

    <div class="form-group">
        <input id="author" name="author" type="text" class="form-control" placeholder="Autor" required>
        @if ($errors->has('author'))
            @foreach ($errors->get('author') as $message)
                <div class="alert alert-danger">{{ $message }}</div>
            @endforeach
        @endif
    </div>

    <div class="form-group">
        <select name="selected_category" id="selected_category" class="form-control" onchange="updateSubcategoriesList();" required>
            <option value="" selected="selected">Wybierz kategorię główną..</option>
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
        <div class="form-group">
        <select name="selected_subcategory" id="selected_subcategory" class="form-control" required>
             <option value="" selected="selected">Wybierz podkategorię..</option>
        </select>
    </div>
    <div class="form-group">
        <textarea id="mceEditor" name="contents"></textarea>
    </div>
    <div class="btn-group btn-group-justified">
        <a class="btn btn-primary" role="button" onclick="saveArticle();">Zapisz</a>
        <a class="btn btn-primary" role="button" href="{{ URL::to('/') }}/auth/dashboard}">Anuluj</a>
    </div>
    <!--
    <button type="button" onclick="saveArticle();" class="btn btn-primary btn-block">Zapisz</button>
</form> -->
@stop
