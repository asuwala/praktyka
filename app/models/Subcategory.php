<?php

class Subcategory extends Eloquent {
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subcategories';
    
    
    /**
     * Reguły walidacji dla rejestracji nowego użytkownika
     * @var type 
     */
    public static $rules = array(
        'name' => 'required|min:2|max:128',
        'description' => 'max:256'
    );
    
    public static $messages = array(
        'required' => 'Pole nie może być puste.',
        'min' => 'Minimalna liczba znaków w polu to :min.',
        'max' => 'Maksymalna liczba znaków w polu to :max.',
    );
    
    /*
     * Zwraca kategorię nadrzędną.
     */
    public function category(){
        return $this->belongsTo('Category');
    }
    
    /*
     * Zwraca liste arytkułów przypisanych do podkategorii
     */
    public function articles()
    {
        return $this->hasMany('Article');
    }
}

?>
