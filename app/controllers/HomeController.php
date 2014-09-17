<?php

class HomeController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    

    public function home() {
        if(Session::has('chosen_subcategory')) {
            Session::forget('chosen_subcategory');
        }
        $categories = Category::all();

        $kb_category = Category::where('name','=','Baza wiedzy')->first();
        $ex_category = Category::where('name','=','Ćwiczenia')->first();
        
        $k = 0;
        //$article = DB::table('articles')->first();
        $max_date = DB::table('articles')->max('created_at');
        //if ($k) {
        if ($max_date) {
            //$max_date = DB::table('articles')->max('created_at');
            $article = DB::table('articles')->where('created_at', '=', $max_date)->first();
            $subcategory = Subcategory::find($article->subcategory_id);
            $category = Category::find($subcategory->category_id);

            return View::make('home.home_page')->with(array('flg' => 1,
                'article' => $article,
                'category' => $category,
                'subcategory' => $subcategory,
                'categories' => $categories,
                'kbCategory' => $kb_category,
                'exCategory' => $ex_category,
                ));
        } else {

        
        //$article = DB::table('articles')->first();
//data = date("d-m-Y", strtotime(date.now()));
       
            return View::make('home.home_page')->with(array('flg' => 0,
                'categories' => $categories,
                'kbCategory' => $kb_category,
                'exCategory' => $ex_category));
        }
    }
    
    
    public function showArticlesList($subcategoryId) {
        if(Session::has('chosen_subcategory')) {
            Session::forget('chosen_subcategory');
        }
        Session::put('chosen_subcategory', $subcategoryId);
        
        $subcategory = Subcategory::find($subcategoryId);
        $category = $subcategory->category;
        //$articles = $subcategory->articles;
        $articles = DB::table('articles')->where('subcategory_id', '=', $subcategory->id)->orderBy('created_at', 'desc')->get();
        //$articles = $subcategory->descArticles();
        $kb_category = Category::where('name','=','Baza wiedzy')->first();
        $ex_category = Category::where('name','=','Ćwiczenia')->first();
        $flg = DB::table('articles')->where('subcategory_id', '=', $subcategory->id)->count();    
        return View::make('home.show_articles_list')->with(array(
            'flg' => $flg,
            'articles' => $articles,
            'kbCategory' => $kb_category,
            'exCategory' => $ex_category,
            'category' => $category,
            'subcategory' => $subcategory));
    }

}

?>
