<?php

// funkcja do debugowania
function debugToConsole($data) {

    if (is_array($data))
        $output = "<script>console.log( 'Debug Objects: " . implode(',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo json_encode($output);
}

class ArticleController extends BaseController {

    
    
    
    public function getManagePanel() {
        $all_categories = Category::all();
        return View::make('articles.manage_panel')
                ->with(array('categories' => $all_categories));
    }
    
    public function getNewestArticle() {
         //$article = Article::find($articleId)=>;
        
         $max_date = DB::table('articles')->max('created_at')->get();
         if($max_date) {
            $article = DB::table('articles')->where('created_at','=',$max_date)->get();
         
            $subcategory = $article->subcategory;
            $category = $subcategory->category;
         /*
         $meta1 = 'Dodany przez <b>' + $article->author + '</b> w dniu ' + date("d-m-Y", strtotime($article->created_at)) + ' o godz. ' + date("H:i",strtotime($article->created_at));
         $responseData = array('error' => 0,
                                'title' => $article->title,
                               'author' => $article->author,
                               'content' => $article->content,
                               'categoryName' => $category->name,
                               'subcategoryName' => $subcategory->name,
                               'meta1' => $meta1
                    );
         } else {
             $responseData = array('error' => 1);
         }
        
            
            
       
        
        // wysłanie odpowiedzi na żądanie klienta w formacie JSON
        return json_encode($responseData);
        */ 
            return $article;
         }
         return 0;
    }
          

    
    public function postRetrieve() {
        /*
        $art1 = array('id' => 3,
            'author' => 'test',
            'title' => 'Testowy artykuł',
            'created_at' => '20 września 2013',
            'updated_at' => '11 stycznia 2014');
        
        $art2 = array('id' => 4,
            'author' => 'test2',
            'title' => 'Testowy artykuł z dłższym tytułem od poprzedniego na liście. Lorem ipsum dot lor en kasula per vidia.',
            'created_at' => '11 maja 2010',
            'updated_at' => '20 stycznia 2014');
        
        
        $art[] = $art1;
        $art[] = $art2;
        return json_encode($art);
        */
        //
        //$category_id = Input::get('categoryId');
        $subcategory_id = Input::get('subcategoryId');
        /*
        if($subcategory_id) {
            $articles = Subcategory::find($subcategory_id)->articles;
            return json_encode($articles);
        } 
         
         */
        $subcategory = Subcategory::find($subcategory_id);
        $articles = $subcategory->articles;
        //foreach ($subcategories as $el) {
        //    $articles[] = $el->articles;
        //} 
        
        return $articles->toJson();
    }
    
    /*
     * Funkcja wyświetla artykuł o podanym id
     */
    public function showArticle($articleId) {
        // pobranie danych o artykule
        $article = Article::find($articleId);
        $subcategory = Article::find($articleId)->subcategory;
        //$subcategory_name = $subcategory['name'];
        
        $category = $subcategory->category;
        //$edit_url = "/articles/" + $article->id + "/edit";
        //$remove_url = "/articles/" + $article->id + "/remove";
        //$base_url = URL::base();
        //$category = 'kategoria';
        // przejście do widoku z formularzem utworzenia nowego artykułu
        return View::make('articles.show_single')
                ->with(array('article' => $article,
                    'subcategory' => $subcategory,
                    'category' => $category
            ));
        
    }
    
    
    /*
     *  Funkcja wyświetla formularz utworzenia nowego artykułu.
     */
    public function getCreate() {

        // pobranie danych o kategoriach głównych
        $categories = Category::all();

        // przejście do widoku z formularzem utworzenia nowego artykułu
        return View::make('articles.create')->with(array('categories' => $categories));
    }

    
    public function postCreate() {

        // pobranie danych z formularza
        $data = Input::all();
        
        // inicjalizacja odpowiedzi na żądanie
        //$responseData = array('status' => "init",
        //                      'message' => "before validation..");

        
        // zmiana typu zmiennej zawierającej id podkategorii - przychodzi jako napis a potrzebna jest liczba
        //$data['subcategory_id']=(int)Input::get('subcategory_id');
        //$editor_content = (string)Input::get('contents');
        //$editor = $editor_content;
        //if(strlen($editor_content)==0) {
        //    $editor = "Zawartość jest pusta";
        //}
        // formularz podaje id podkategorii w polu o innej nazwie niż wymaga tego walidator
        $data['subcategory_id']=Input::get('selected_subcategory');
            //editor = "Zawartość jest pusta";
        
        // utworzenie obiektu walidacji 
        // parametry to:
        // - dane pobrane z formularza
        // - tablica z regułami walidacji danych formularza dla modelu Article
        // - tablica z komunikatami wyświetlanymi użytkownikowi w sytuacji, gdy wprowadzone dane nie przeszły walidacji
        $validator = Validator::make($data, Article::$rules, Article::$messages);
        if ($validator->passes()) {
            // dane poprawne - można zapisać artykuł do bazy
            
            // utworzenie artykułu
            $article = new Article();
            $article->title = $data['title'];
            $article->author = $data['author'];
            $article->contents = $data['contents'];

            // pobranie podkategorii, do której przypisany zostanie artykuł
            //$sub_id = $data['subcategory_id'];
            $subcategory = Subcategory::find($data['subcategory_id']);
            
            // zapisanie artykułu w bazie
            $article = $subcategory->articles()->save($article);
            //$redirect_url = "../articles/{" + $article->id + "}";
            // dane do wysłania w odpowiedzi na żądanie
            //$responseData = array('status' => "success",
            //                      'redirect' => $redirect_url);
            // przekierowanie do panelu uzytkownika po poprawnym dodaniu podkategorii do bazy
            return Redirect::to('articles/' . $article->id)
                    ->with(array('message' => 'Artykuł został pomyślnie zapisany w bazie.',
                        'mtype' => 'success'
                ));
        }
        else {
        
            // walidacja nie powidoła się
            
            // pobranie wiadomości z błędami walidacji
            //Session::put();
            //$errors = $validator->messages();
            //Session::put('');
            
            //return Redirect::to('articles/create')->withErrors($validator);
            return Redirect::to('articles/create')->withErrors($validator)->withInput();
            
   
        
        // wysłanie odpowiedzi na żądanie klienta w formacie JSON
        //return json_encode($responseData);
        }
    }
    
    
    public function getEdit($articleId) {
        // pobranie wszystkich kategorii głównych
        $all_categories = Category::all();
        
        // pobranie danych o artykule
        $article = Article::find($articleId);
        
        // podkategoria do której przypisany jest artykuł
        $subcategory = $article->subcategory;
        
        // kategoria główna do ktęój przypisany jest artykuł
        $category = $subcategory->category;
        
        // wszystkie podkategorie należące do kategorii głównej
        $subcategories = $category->subcategories;
        
        // id kategorii głównej
        $category_id = $category->id;
        
        // id podkategorii
        $subcategory_id = $subcategory->id;

        // przejście do widoku z formularzem edycji artykułu
        return View::make('articles.edit')
                ->with(array('article' => $article,
                    'category_id' => $category_id,
                    'categories' => $all_categories,
                    'subcategory_id' => $subcategory_id,
                    'subcategories' => $subcategories      
            ));

        // przejście do widoku z formularzem utworzenia nowego artykułu
        //return View::make('articles.create')->with(array('categories' => $categories));
    }
    
    /*
     * Funkcja odpowiada za zapisanie zmian w artykule po wypełnieniu formularza edycji artykułu.
     */
    public function postEdit($articleId) {
        
        // pobranie danych z formularza
        $data = Input::all();
        // formularz podaje id podkategorii w polu o innej nazwie niż wymaga tego walidator
        $data['subcategory_id']=Input::get('selected_subcategory');
        
        // utworzenie obiektu walidacji 
        // parametry to:
        // - dane pobrane z formularza
        // - tablica z regułami walidacji danych formularza dla modelu Article
        // - tablica z komunikatami wyświetlanymi użytkownikowi w sytuacji, gdy wprowadzone dane nie przeszły walidacji
        $validator = Validator::make($data, Article::$rules, Article::$messages);
        
        if ($validator->passes()) {
            // dane poprawne - można zapisać zmiany w artykule

            // odszukanie artykułu w bazie
            $article = Article::find($articleId);
            $article->title = $data['title'];
            $article->author = $data['author'];
            $article->contents = $data['contents'];

            // pobranie podkategorii, do której przypisany zostanie artykuł
            $sub_id = $data['subcategory_id'];
            $subcategory = Subcategory::find($sub_id);
            
            // zapisanie artykułu w bazie
            $article = $subcategory->articles()->save($article);
            // przekierowanie do panelu uzytkownika po poprawnym dodaniu podkategorii do bazy
            return Redirect::to('articles/' . $article->id)
                    ->with(array('message' => 'Zmiany w artykule zostały pomyślnie zapisane.',
                        'mtype' => 'success'
                ));
        }
       
        // walidacja nieudana - zapamiętanie zmian wprwoadzonych przez użytkownika
        // i ponowne wyświetlenie formularza edycji artykułu
        $old_article = Article::find($articleId);
        $old_article->title = $data['title'];
        $old_article->author = $data['author'];
        $old_article->contents = $data['contents'];
        
        // pobranie wszystkich kategorii głównych
        $all_categories = Category::all();
            
        // podkategoria do której przypisany jest artykuł
        $subcategory = $old_article->subcategory;
        
        // kategoria główna do ktęój przypisany jest artykuł
        $category = $subcategory->category;
        
        // wszystkie podkategorie należące do kategorii głównej
        $subcategories = $category->subcategories;
        
        $category_id = $category->id;
        $subcategory_id = $subcategory->id;
        
        return Redirect::to('articles/' . $articleId . '/edit')
                ->with(array('category_id' => $category_id,
                    'categories' => $all_categories,
                    'subcategory_id' => $subcategory_id,
                    'subcategories' => $subcategories)) 
                ->withErrors($validator)
                ->withInput();
    }
    
    public function getRemove($articleId) {
        $article = Article::find($articleId);
        $article->delete();
        return Redirect::to('articles/manage-panel')
                    ->with(array('message' => 'Artykuł został usunięty z bazy.',
                        'mtype' => 'success'
                ));
    }
    
    
    
    
    
    
    
    /** FUNKCJA UTWORZENIA ARTYKUŁU DO UZYCIA z jQery ajax
     * Funkcja wywoływana po wypełnieniu 
     * forumlarza utworzenia artykułu i kliknięciu przycisku Zapisz.
     * Zapisuje nowy artykuł do bazy.
     */
    /*
    public function postCreate() {

        // pobranie danych z formularza
        $data = Input::all();
        
        // inicjalizacja odpowiedzi na żądanie
        $responseData = array('status' => "init",
                              'message' => "before validation..");

        
        // zmiana typu zmiennej zawierającej id podkategorii - przychodzi jako napis a potrzebna jest liczba
        $data['subcategory_id']=(int)Input::get('subcategory_id');
        
        // utworzenie obiektu walidacji 
        // parametry to:
        // - dane pobrane z formularza
        // - tablica z regułami walidacji danych formularza dla modelu Article
        // - tablica z komunikatami wyświetlanymi użytkownikowi w sytuacji, gdy wprowadzone dane nie przeszły walidacji
        $validator = Validator::make($data, Article::$rules, Article::$messages);
        if ($validator->passes()) {
            // dane poprawne - można zapisać artykuł do bazy
            
            // utworzenie artykułu
            $article = new Article();
            $article->title = $data['title'];
            $article->author = $data['author'];
            $article->contents = $data['contents'];

            // pobranie podkategorii, do której przypisany zostanie artykuł
            $sub_id = $data['subcategory_id'];
            $subcategory = Subcategory::find($sub_id);
            
            // zapisanie artykułu w bazie
            $article = $subcategory->articles()->save($article);
            $redirect_url = "../articles/{" + $article->id + "}";
            // dane do wysłania w odpowiedzi na żądanie
            $responseData = array('status' => "success",
                                  'redirect' => $redirect_url);
        }
        else {
            // walidacja nie powidoła się
            
            // pobranie wiadomości z błędami walidacji
            $errors = $validator->messages();
            
            // przygotowanie danych do wysłania w odpowiedzi na żądanie
            $responseData = array('status' => "error",
                                  'message' => "validation failed");
            
            // w odpowiedzi wysyłane są wszystkei dane z formularza 
                $responseData['cur_author'] = $data['author'];
                $responseData['cur_title'] = $data['title'];
                $responseData['cur_subcategory_id'] = $data['subcategory_id'];
                $responseData['cur_contents'] = $data['contents'];
            
            // i dodatkowo jeśli był błąd dla pola Autor
            if ($errors->has('author'))
            {
                // wiadomość o błędzie dla tego pola
                $responseData['msg_author'] = $errors->first('author');
            }
            if ($errors->has('title'))
            {
                $responseData['msg_title'] = $errors->first('title');
            }
            if ($errors->has('subcategory_id'))
            {
                $responseData['msg_subcategory_id'] = $errors->first('subcategory_id');
            }
            if ($errors->has('contents'))
            {
                $responseData['msg_contents'] = $errors->first('contents');
            }
        }
        
        // wysłanie odpowiedzi na żądanie klienta w formacie JSON
        return json_encode($responseData);

    }
    */
    
    
    
    /* FUNKCJA DO UZYCIA z JQuery ajax
    public function apostEdit($articleId) {
        // pobranie danych z formularza
        $data = Input::all();
        
        // inicjalizacja odpowiedzi na żądanie
        $responseData = array('status' => "init",
                              'message' => "before validation..");

        
        // zmiana typu zmiennej zawierającej id podkategorii - przychodzi jako napis a potrzebna jest liczba
        $data['subcategory_id']=Input::get('subcategory_id');
        
        // utworzenie obiektu walidacji 
        // parametry to:
        // - dane pobrane z formularza
        // - tablica z regułami walidacji danych formularza dla modelu Article
        // - tablica z komunikatami wyświetlanymi użytkownikowi w sytuacji, gdy wprowadzone dane nie przeszły walidacji
        $validator = Validator::make($data, Article::$rules, Article::$messages);
        if ($validator->passes()) {
            // dane poprawne - można zapisać artykuł do bazy
            $articleId = $data['artticleId'];
            // utworzenie artykułu
            $article = Article::find($articleId);
            $article->title = $data['title'];
            $article->author = $data['author'];
            $article->contents = $data['contents'];

            // pobranie podkategorii, do której przypisany zostanie artykuł
            $sub_id = $data['subcategory_id'];
            $subcategory = Subcategory::find($sub_id);
            
            // zapisanie artykułu w bazie
            $article = $subcategory->articles()->save($article);
            $redirect_url = "../articles/{" + $article->id + "}";
            // dane do wysłania w odpowiedzi na żądanie
            $responseData = array('status' => "success",
                                  'redirect' => $redirect_url);
        }
        else {
            // walidacja nie powidoła się
            
            // pobranie wiadomości z błędami walidacji
            $errors = $validator->messages();
            
            // przygotowanie danych do wysłania w odpowiedzi na żądanie
            $responseData = array('status' => "error",
                                  'message' => "validation failed");
            
            // w odpowiedzi wysyłane są wszystkei dane z formularza 
                $responseData['cur_author'] = $data['author'];
                $responseData['cur_title'] = $data['title'];
                $responseData['cur_subcategory_id'] = $data['subcategory_id'];
                $responseData['cur_contents'] = $data['contents'];
            
            // i dodatkowo jeśli był błąd dla pola Autor
            if ($errors->has('author'))
            {
                // wiadomość o błędzie dla tego pola
                $responseData['msg_author'] = $errors->first('author');
            }
            if ($errors->has('title'))
            {
                $responseData['msg_title'] = $errors->first('title');
            }
            if ($errors->has('subcategory_id'))
            {
                $responseData['msg_subcategory_id'] = $errors->first('subcategory_id');
            }
            if ($errors->has('contents'))
            {
                $responseData['msg_contents'] = $errors->first('contents');
            }
        }
        
        // wysłanie odpowiedzi na żądanie klienta w formacie JSON
        return json_encode($responseData);
    }
    
     * 
     */

}

?>
