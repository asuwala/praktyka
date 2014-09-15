<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * Tworzy tabele 'subcategories' z kolumnami:
     * id - identyfikator podkategorii (autoincrement)
     * category_id - klucz obcy do tabeli 'categories'
     * name - nazwa podkategorii (wymagana)
     * description - opis kategorii (niewymagany)
     * created_at - kiedy utowrzony (tworzone przez temestamps() )
     * updated_at - kiedy aktualizowany (tworzone przez timestamps() )
     * 
     * @return void
     */
    public function up() {
        Schema::create('subcategories', function(Blueprint $table) {
                    $table->increments('id');
                    $table->integer('category_id')->unsigned();
                    $table->foreign('category_id')
                            ->references('id')->on('categories')
                            ->onDelete('restrict');
                    $table->string('name', 128)->nullable(false);
                    $table->string('description', 256)->nullable();
                    $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     * Usuwa tabelę 'subcategories' 
     * @return void
     */
    public function down() {
        Schema::drop('subcategories');
    }

}