@extends('layouts.base')

@section('head')
<!-- Place inside the <head> of your HTML -->
<script type="text/javascript">
    var isAuth = "{{Auth::check()}}";
</script>
<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@stop

@section('menu-content')
<div id="home-page-menu">
    <div id="menu-header" class="menu-header-title">
    <a class="list-group-item active disabled" onclick="hideMenu();">Baza artykułów</a>
    </div>
    
    <a id="menu-category-kb" class="list-group-item menu-category disabled" onclick="showKbMenu();">Baza wiedzy</a>
    @if(Session::has('kbCategory'))
    <div id="menu-kb-subcategories" style="display:none">
    
        @foreach ($kbCategory->subcategories as $subc)
            <a href="{{ URL::to('/') }}/home/subcategory/{{$subc->id}}/articles" class="list-group-item menu-subcategory">{{$subc->name}}</a>
        @endforeach
    </div>
    @endif
    @if(Auth::check())
        <a id="menu-category-ex" class="list-group-item menu-category disabled" onclick="showExMenu();">Ćwiczenia</a>
        @if(Session::has('exCategory'))
            <div id="menu-ex-subcategories" style="display:none">
            @foreach ($exCategory->subcategories as $subc)
                <a href="{{ URL::to('/') }}/home/subcategory/{{$subc->id}}/articles" class="list-group-item menu-subcategory">{{$subc->name}}</a>
            @endforeach
        </div>
        @endif
    @endif
</div>
@stop

@section('content')
<div id="home-page-content">
<div class="panel panel-primary">
  <!-- Default panel contents -->

      <div class="panel-heading">
        <h3 class="panel-title">Najnowszy artykuł w bazie</h3>
      </div>
  <div class="panel-body">
    <div class="row">

        <div class="col-sm-12 blog-main">

          <div class="blog-post">
              <br>

              @if($flg)
                <h3 class="blog-post-title">{{ $article->title }}</h3>

                <p class="blog-post-meta article-category">Kategoria: {{ $category->name }} -> {{ $subcategory->name }}</p>

               
                <hr>
                <div class="article-content">
                    {{ $article->contents }}
                </div>
                <hr>
                <p class="blog-post-meta article-meta-info">Dodany w dniu {{date("d-m-Y", strtotime($article->created_at))}} o godz. {{date("H:i",strtotime($article->created_at))}} przez <b>{{ $article->author }}</b></p>
                <!--
                @if($article->created_at != $article->updated_at)
                <p class="article-meta-info">Ostatnio edytowany w dniu {{date("d-m-Y", strtotime($article->updated_at))}} o godz. {{date("H:i",strtotime($article->updated_at))}}</p>
                @endif
                -->
              @else
              
                <h3 class="blog-post-title">Baza artykułów jest pusta ;(</h3>
              @endif

          </div><!-- /.blog-post -->
       </div> 
   </div>
  </div>
</div>
</div>
@stop
