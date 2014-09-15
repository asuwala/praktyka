<?php

class CategoryTableSeeder extends Seeder {

    public function run() {
        DB::table('categories')->delete();

        Category::create(array(
            'name' => 'Baza Wiedzy',
            'description' => 'W kategorii tej znajdują się materiały, z którymi należy się zapoznać przed rozpoczęciem wykonywania ćwiczeń.',
        ));
        Category::create(array(
            'name' => 'Ćwiczenia',
            'description' => 'W kategorii tej znajdują się ćwiczenia do samodzielnego wykonania.',
        ));
    }

}

?>
