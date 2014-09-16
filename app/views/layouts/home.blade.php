@extends('layouts.base')

@section('head')

<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@stop

@section('menu-content')
<div id="home-page-menu">
    <div id="menu-header" class="menu-header-title">
    <a href=" {{ URL::to('/') }}/home" class="list-group-item active" onclick="hideMenu();">Baza artykułów</a>
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

@stop