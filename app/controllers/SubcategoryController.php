<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubcategoryController
 *
 */
class SubcategoryController extends BaseController {
   
    
    
    
    public function managePanel() {
        
        $all_categories = Category::all();
        $first_category = Category::first();
        $subcategories = $first_category->subcategories;
        
        return View::make('subcategories.manage_panel')
                ->with(array('categories' => $all_categories,
                    'subcategories' => $subcategories,
                    'first_category_id' => $first_category->id
            ));
        
    }
    /**
     * Funkcja przygotowująca formularz dodawania nowej podkategorii.
     * @return type
     */
    public function getCreate() {
        
        // pobranie z bazy danych o  kategoriach głównych
        $categories = Category::all();
        
        // przejście do widoku z formularzem dodawania nowej podkategorii
        return View::make('subcategories.create')->with(array('categories' => $categories));
    }

    /**
     * Funkcja uruchamiana po wypełnieniu forumlarza dodania nowej podkategorii
     * 
     */
    public function postCreate() {
        // pobranie danych z formularza dodania nowej podkategorii
        $data = Input::all();

        // utworzenie obiektu walidacji, 
        // parametry to dane do sprawdzenia i tablica z regułami walidacji z modelu Subcategory
        $validator = Validator::make($data, Subcategory::$rules, Subcategory::$messages);

        // sprwadzamy czy dane w formularzu są poprawne
        if ($validator->passes()) {
            
            // jeśli dane są poprawne to tworzymy nowy obiekt podkategorii
            $subcategory = new Subcategory;
            $subcategory->name = Input::get('name');
            if (strlen(Input::get('description')) > 0){
                $subcategory->description = Input::get('description');
            }
            $subcategory->category_id = Input::get('selected_category');
            
            // i zapisujemy podkategorie do bazy
            $subcategory->save();
            
            // przekierowanie do panelu uzytkownika po poprawnym dodaniu podkategorii do bazy
            return Redirect::to('subcategories/manage-panel')
                    ->with(array('message' => 'Podkategoria została pomyślnie dodana do bazy.',
                        'mtype' => 'success'
                ));
            // return Redirect::to('auth/login')->with('message', 'Dziękujemy za rejestrację!');
        } else {
            // dane w formularzu są nieprawidłowe, powrót do formularza z wypisaniem błędów
            return Redirect::to('subcategories/create')
                    //->with('message', 'W formularzu wystapiły błędy!')
                    ->withErrors($validator)->withInput();
        }
    }
    
    
    public function getEdit($subcategoryId) {
        // pobranie wszystkich kategorii głównych
        $all_categories = Category::all();
        
        // pobranie danych o artykule
        $subcategory = Subcategory::find($subcategoryId);
        
        // podkategoria do której przypisany jest artykuł
        //$subcategory = $article->subcategory;
        
        // kategoria główna do ktęój przypisany jest artykuł
        $category = $subcategory->category;
        
        // wszystkie podkategorie należące do kategorii głównej
        //$subcategories = $category->subcategories;
        
        // id kategorii głównej
        $category_id = $category->id;
        
        // id podkategorii
        $subcategory_id = $subcategory->id;

        // przejście do widoku z formularzem edycji artykułu
        return View::make('subcategories.edit')
                ->with(array('subcategory' => $subcategory,
                    'category_id' => $category_id,
                    'categories' => $all_categories,
                    'subcategory_id' => $subcategory_id,      
            ));
    }
    
    public function postEdit($subcategoryId) {
        // pobranie danych z formularza edycji podkategorii
        $data = Input::all();
        //$id = Input::get('subcategory_id');
        // utworzenie obiektu walidacji, 
        // parametry to dane do sprawdzenia i tablica z regułami walidacji z modelu Subcategory
        $validator = Validator::make($data, Subcategory::$rules, Subcategory::$messages);

        // sprwadzamy czy dane w formularzu są poprawne
        if ($validator->passes()) {
            
            // jeśli dane są poprawne to pobieramy podkategorie z bazy i zmieniamy jej dane
            $subcategory = Subcategory::find($subcategoryId);
            $subcategory->name = Input::get('name');
            
            $subcategory->description = Input::get('description');
            
            $subcategory->category_id = Input::get('selected_category');
            
            // i zapisujemy zmiany do bazy
            $subcategory->save();
            
            // przekierowanie do panelu uzytkownika po poprawnym dodaniu podkategorii do bazy
            return Redirect::to('subcategories/manage-panel')
                    ->with(array('message' => 'Zmiany w podkategorii zostały pomyślnie zapisane.',
                        'mtype' => 'success'
                ));
            // return Redirect::to('auth/login')->with('message', 'Dziękujemy za rejestrację!');
        } else {
            // dane w formularzu są nieprawidłowe, powrót do formularza z wypisaniem błędów
            return Redirect::to('subcategories/'. $subcategoryId . '/edit')
                    //->with(array('message' => 'Formularz zawiera błędy!',
                    //    'mtype' => 'danger'))
                    ->withErrors($validator)
                    ->withInput();
        }
    }
    
    public function getRemove($subcategoryId) {
        $subcategory = Subcategory::find($subcategoryId);
        if($subcategory->articles()->count() > 0) {
            return Redirect::to('subcategories/manage-panel')
                ->with(array('subcategory_id' => $subcategoryId,
                    'message' => 'Usunięcie wybranej podkategorii nie było możliwe ponieważ przypisany jest do niej co najmniej jeden artykuł.</br>
                        Aby usunąć podkategorię należy w pierwszej kolejności usunąć (lub przypisać do innej podkategorii) artykuły do niej przypisane.',
                    'mtype' => 'danger'));
        }
        $subcategory->delete();
        return Redirect::to('subcategories/manage-panel')
                    ->with(array('message' => 'Podkategoria została pomyślnie usunięta.',
                        'mtype' => 'success'
                ));
    }
    
    
  
        /**
     * Funkcja zwracająca podkategorie należące do kategorii głównej wskazanej przez parametr.
     * @return type
     */
    public function postRetrieve() {
        //$data = Input::all();
        $categoryId = Input::get('categoryId');
        //$categoryId=1;
        //echo 'Jestem w kontrolerze ' + $categoryId;
        //$category = Category::find($categoryId);
        //$count = Subcategory::all()->count();
        $subcategories = Subcategory::where('category_id', '=', $categoryId)->get();
        return $subcategories->toJson();
        //$data = json_encode($subcategories);
        //return Response::json($subcategories);
        //echo 'Pusty tekst';
        //echo $subcategories;
        //echo json_encode($subcategories);

    }
}

?>
