@extends('layouts.dashboard')

@section('head')
<script type="text/javascript" src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/appelfinder.js') }}"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea#mceEditor",
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
<div class="panel panel-primary">
  <!-- Default panel contents -->

      <div class="panel-heading">
        <h3 class="panel-title">Edytuj artykuł</h3>
      </div>
  <div class="panel-body">
<form method="POST" action="edit" accept-charset="UTF-8">
    <div class="form-group">
        <input id="old_title" type="hidden" value="{{ Session::getOldInput('title') }}">
        <input id="title" name="title" type="text" class="form-control" placeholder="Tytuł" value="{{ $article->title }}" required>
        @if (Session::hasOldInput('title'))
            <script type="text/javascript">
                document.getElementById('title').value=document.getElementById('old_title').getAttribute("value");
            </script>
        @endif 
        @foreach ($errors->get('title') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
            @endforeach
        

    </div>

    <div class="form-group">
        <input id="old_author" type="hidden" value="{{ Session::getOldInput('author') }}">
        <input id="author" name="author" type="text" class="form-control" placeholder="Autor" value="{{ $article->author }}" required>
        @if (Session::hasOldInput('author'))
            <script type="text/javascript">
                document.getElementById('author').value=document.getElementById('old_author').getAttribute("value");
            </script>
        @endif 
            @foreach ($errors->get('author') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
            @endforeach
        

    </div>

    <div class="form-group">
            
        <select name="selected_category" id="selected_category" class="form-control" onchange="updateSubcategoriesList();" required>
            @foreach ($categories as $category)
                @if ($category->id==$category_id)
                    <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
                @else
                    <option value="{{$category->id}}">{{ $category->name }}</option>
                @endif
            @endforeach
        </select>
        @foreach ($errors->get('selected_category') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
            @endforeach
    </div>
    
    <div class="form-group">
            
        <select name="selected_subcategory" id="selected_subcategory" class="form-control" required>
             @foreach ($subcategories as $subcategory)
                @if ($subcategory->id==$subcategory_id)
                    <option value="{{$subcategory->id}}" selected="selected">{{ $subcategory->name }}</option>
                @else
                    <option value="{{$subcategory->id}}">{{ $subcategory->name }}</option>
                @endif
            @endforeach
        </select>
            @foreach ($errors->get('selected_subcategory') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
            @endforeach

    </div>
    <div class="form-group">
        <input id="old_mceEditor" type="hidden" value="{{ Session::getOldInput('contents') }}"></input>
        <textarea id="mceEditor" name="contents">{{ $article->contents }}</textarea>
        @if (Session::hasOldInput('contents'))
            <script type="text/javascript">
                //tinymce.get('mceEditor').setContent(document.getElementById('old_mceEditor').getAttribute("value"));
                document.getElementById('mceEditor').innerHTML=document.getElementById('old_mceEditor').getAttribute("value");
            </script>
        @endif 
        @foreach ($errors->get('contents') as $msg)
                <div class="alert alert-danger" role="alert">{{ $msg }}</div>
            @endforeach
    </div>
    <div class="btn-group btn-group-justified">
        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Zapisz</button>
        </div>
    <!--    <a class="btn btn-primary" role="button" href="{{ URL::to('/') }}/articles/manage-panel">Anuluj</a> -->
    <a class="btn btn-primary" role="button" onclick="history.go(-1);">Anuluj</a>

    </div>

    <!--
    <button type="button" onclick="saveArticle();" class="btn btn-primary btn-block">Zapisz</button>
     -->
</form>
  </div>
    </div>



<!--
<form method="POST" action="edit" accept-charset="UTF-8">
    <h3>Edytuj artykuł</h3><br>
    <div class="form-group">
        <input id="title" name="title" value="{{ $article->title }}" type="text" class="form-control" placeholder="Tytuł" required>
        @if ($errors->has('title'))
            @foreach ($errors->get('title') as $message)
                <div class="alert alert-danger">{{ $message }}</div>
            @endforeach
        @endif
    </div>

    <div class="form-group">
        <input id="author" name="author" value="{{ $article->author }}" type="text" class="form-control" placeholder="Autor" required>
        @if ($errors->has('author'))
            @foreach ($errors->get('author') as $message)
                <div class="alert alert-danger">{{ $message }}</div>
            @endforeach
        @endif
    </div>

    <div class="form-group">
        <select name="selected_category" id="selected_category" class="form-control" onchange="updateSubcategoriesList();" required>
            @foreach ($categories as $category)
                @if ($category->id==$category_id)
                    <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
                @else
                    <option value="{{$category->id}}">{{ $category->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
        <div class="form-group">
        <select name="selected_subcategory" id="selected_subcategory" class="form-control" required>
            @foreach ($subcategories as $subcategory)
                @if ($subcategory->id==$subcategory_id)
                    <option value="{{$subcategory->id}}" selected="selected">{{ $subcategory->name }}</option>
                @else
                    <option value="{{$subcategory->id}}">{{ $subcategory->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <textarea id="mceEditor" name="contents">{{$article->contents}}</textarea>
    </div>
    <div class="btn-group btn-group-justified">
        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Zapisz</button>
        </div>
        <a class="btn btn-primary" role="button" href="{{ URL::to('/') }}/articles/{{$article->id}}">Anuluj</a>
    </div>
 </form>  -->  
    <!--
    <div class="btn-group btn-group-justified">
        <a class="btn btn-primary" role="button" onclick="saveEditedArticle();">Zapisz</a>
        <a class="btn btn-primary" role="button" href="{{ URL::to('/') }}/articles/{{$article->id}}">Anuluj</a>

    </div>
        -->
    <!--
    <div class="btn-group">
        <button type="button" onclick="saveEditedArticle();" class="btn btn-primary">Zapisz zmiany</button>
        <button type="button" onclick="{{ action('ArticleController@showArticle', array('3')); }} "class="btn btn-primary">Anuluj</button>
    </div>
    -->


@stop
