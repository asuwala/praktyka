<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

    /**
     * Run the migrations.
     *
     * Tworzy tabele 'articles' z kolumnami:
     * id - identyfikator podkategorii (autoincrement)
     * subcategory_id - klucz obcy do tabeli 'subcategories' 
     *                  artykuł przypisywany jest do pojedynczej podkategorii
     * title - tytuł artykułu (wymagany)
     * author - tytuł artykułu (wymagany)
     * contents - treść artykułu (wymagana)
     * created_at - kiedy utowrzony (tworzone przez temestamps() )
     * updated_at - kiedy aktualizowany (tworzone przez timestamps() )
     * 
     * @return void
     */
    public function up() {
        Schema::create('articles', function(Blueprint $table) {
                    $table->increments('id');
                    $table->integer('subcategory_id')->unsigned();
                    $table->foreign('subcategory_id')
                            ->references('id')->on('subcategories')
                            ->onDelete('restrict');
                    $table->string('title', 256)->nullable(false);
                    $table->string('author', 64)->nullable(false);
                    $table->text('contents')->nullable(false);
                    $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     * Usuwa tabelę 'articles'
     * @return void
     */
    public function down() {
        Schema::drop('articles');
    }

}