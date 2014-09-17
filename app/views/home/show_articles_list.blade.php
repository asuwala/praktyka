@extends('layouts.home')




@section('content')
    @if($flg>0)
        @foreach($articles as $article)
        <div class="row home-article-content">

        <div class="col-sm-12 blog-main">

          <div class="blog-post">
              <br>
            <h3 class="blog-post-title">{{ $article->title }}</h3>
            

            <p class="blog-post-meta article-category">Kategoria: {{ $category->name }} -> {{ $subcategory->name }}</p>
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
    <br>
    
        @endforeach
     @else
        <div class="row home-article-content">

        <div class="col-sm-12 blog-main">

          <div class="blog-post">
              <br>
              <p class="blog-post-meta">Brak artykułów w wybranej podkategorii.</p>
          </div><!-- /.blog-post -->
        </div>
        </div>
     @endif
@stop
