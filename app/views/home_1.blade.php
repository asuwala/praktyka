@extends('layouts.base')

@section('head')
<!-- Place inside the <head> of your HTML -->
<script type="text/javascript">
    var isAuth = "{{Auth::check()}}";

    function getNewestArticle() {
        console.log(isAuth);
        var url = window.location.origin + "/articles/get-newest";
        $.ajax({
            url: url,
            type: 'POST',
            data: { isAuth: isAuth  },
            dataType: 'json',
            success: function(data) {
                console.log('succes in getNewest');
                //var p_data = $.parseJSON(data);
                //$.each(p_data, function(i, subc) {
                    //$('#selected_subcategory').
                    //alert(data.status + ': ' + data.message);
                    console.log('data.error: ' + data.error)
                    if(!data.error) {
                        var aTitle = document.getElementById('a_title');
                        aTitle.innerHTML=data.title;
                        var aMeta1 = document.getElementById('a_meta1');
                        aMeta1.innerHTML=data.meta1;
                        var aMeta2 = document.getElementById('a_meta2');
                        aMeta2.innerHTML = data.categoryName + ' -> ' + data.subcategoryName;
                    
                        var aContents = document.getElementById('a_contents');
                        aContents.innerHTML = data.contents;
                    } else {
                        var aTitle = document.getElementById('a_title');
                        aTitle.innerHTML="Baza artykułów jest pusta!";
                    }
                    
            }

        
        });
}
    $( document ).ready(getNewestArticle());

    </script>
@stop

@section('menu-content')
    <a href="{{URL::to('/')}}" class="list-group-item active">Strona główna</a>
    <a href="{{ URL::to('/') }}" class="list-group-item">Baza wiedzy</a>
    <a href="{{ URL::to('/') }}" class="list-group-item">Ćwiczenia</a>
@stop

@section('content')
    <div class="row">

        <div class="col-sm-12 blog-main">

          <div class="blog-post">
              <br>
            <h3 id="a_title" class="blog-post-title">Tytł najnowszego artykulu</h3>

            <p id="a_meta1" class="blog-post-meta"></p>

            <p id="a_meta2"></p>
            <hr>
            <div id="a_contents">
            </div>
            <hr>
          </div><!-- /.blog-post -->
       </div> 
   </div>

@stop
