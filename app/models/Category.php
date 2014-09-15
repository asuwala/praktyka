<?php

class Category extends Eloquent {
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    
    /*
     * Zwraca listę podkategorii przypisanych danej kategorii.
     */
    public function subcategories()
    {
        return $this->hasMany('Subcategory');
    }
}

?>
