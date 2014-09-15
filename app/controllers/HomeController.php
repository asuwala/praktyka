<?php

class HomeController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function home() {
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

            return View::make('home')->with(array('flg' => 1,
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
       
            return View::make('home')->with(array('flg' => 0,
                'categories' => $categories));
        }
    }

}

?>
