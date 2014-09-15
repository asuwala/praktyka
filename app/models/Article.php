<?php

class Article extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';
    
    
    /**
     * Reguły walidacji dla akcji tworzenia artykułu
     * @var type 
     */
    public static $rules = array(
        'title' => 'required|min:3|max:256',
        'author' => 'required|min:3|max:64',
        'subcategory_id' => 'required|numeric',
        'contents' => 'required'
    );
    
    /*
     * Wiadmości do reguł walidacji
     */
    public static $messages = array(
        'required' => 'Pole nie może być puste.',
        'numeric' => 'Pole musi zawierać wartość numeryczną.',
        'min' => 'Minimalna liczba znaków w polu to :min.',
        'max' => 'Maksymalna liczba znaków w polu to :max.',
    );
    
    /*
     * Funkcja zwraca podkategorię do jakiej należy Artykuł
     */
    public function subcategory(){
        return $this->belongsTo('Subcategory');
    }
}

?>
