<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * Tworzy tabele 'categories' z kolumnami:
     * id - identyfikator kategorii (autoincrement)
     * name - nazwa kategorii (wymagana)
     * description - opis kategorii (niewymagany)
     * created_at - kiedy utowrzony (tworzone przez temestamps() )
     * updated_at - kiedy aktualizowany (tworzone przez timestamps() )
     * 
     * @return void
     */
    public function up() {
        Schema::create('categories', function(Blueprint $table) {
                    $table->increments('id');
                    $table->string('name', 128)->nullable(false);
                    $table->string('description', 512)->nullable();
                    $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     * Usuwa tabelę 'categories'
     * @return void
     */
    public function down() {
        Schema::drop('categories');
    }

}