@extends('layouts.base')

@section('head')
<!-- Place inside the <head> of your HTML -->
<script type="text/javascript">
    var isAuth = "{{Auth::check()}}";
    var kbId = "{{$kbCategory->id}}";
    var exId = "{{$exCategory->id}}";
</script>
<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@stop

@section('menu-content')
<div id="home-page-menu">
    <div id="menu-header" class="menu-header-title">
    <a class="list-group-item active disabled" onclick="hideMenu();">Baza artykułów</a>
    </div>
    
    <a id="menu-category-kb" class="list-group-item menu-category disabled" onclick="showKbMenu();">Baza wiedzy</a>
    <div id="menu-kb-subcategories" style="display:none">
        @foreach ($kbCategory->subcategories as $subc)
            <a href=" {{ URL::to('/') }}/home/subcategory/{{$subc->id}}/articles" class="list-group-item menu-subcategory">{{$subc->name}}</a>
            @if($subc->id == Session::get('chosen_subcategory'))
                <script type="text/javascript">
                    $('#menu-kb-subcategories').show();
                </script>
            @endif
        @endforeach
    </div>
    @if(Auth::check())
    <a id="menu-category-ex" class="list-group-item menu-category disabled" onclick="showExMenu();">Ćwiczenia</a>
    <div id="menu-ex-subcategories" style="display:none">
        @foreach ($exCategory->subcategories as $subc)
            <a href="{{ URL::to('/') }}/home/subcategory/{{$subc->id}}/articles" class="list-group-item menu-subcategory">{{$subc->name}}</a>
            @if($subc->id == Session::get('chosen_subcategory'))
                <script type="text/javascript">
                    $('#menu-ex-subcategories').show();
                </script>
            @endif
        @endforeach
    </div>
        
    @endif
</div>
@stop

@section('content')
    @foreach($articles as $article)
        <div class="row home-article-content">

        <div class="col-sm-12 blog-main">

          <div class="blog-post">
              <br>
            <h3 class="blog-post-title">{{ $article->title }}</h3>
            

            <p class="blog-post-meta article-category">Kategoria: {{ $article->subcategory->name }} -> {{ $article->subcategory->category->name }}</p>
            <hr>
            <div class="article-content">
            {{ $article->contents }}
            </div>
            <hr>
            <p class="blog-post-meta article-meta-info">Dodany w dniu {{date("d-m-Y", strtotime($article->created_at))}} o godz. {{date("H:i",strtotime($article->created_at))}} przez <b>{{ $article->author }}</b></p>
            @if ($article->updated_at != $article->created_at)
                <p class="blog-post-meta article-meta-info">Ostatnio zmieniany w dniu {{ date("d-m-Y",strtotime($article->updated_at)) }} o godz. {{ date("H:i",strtotime($article->updated_at)) }}</p>
            @endif
          </div><!-- /.blog-post -->
       </div>
   </div>
    
    @endforeach
@stop
