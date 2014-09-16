@extends('layouts.home')

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
