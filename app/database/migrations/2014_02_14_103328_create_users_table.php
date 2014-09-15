<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     * 
     * Tworzy tabele 'users' z kolumnami:
     * id - identyfikator uzytkownika (autoincrement)
     * username - nazwa użytkownika (wymagany)
     * email - adres email (wymagany, unikalny)
     * password - hasło (wymagany)
     * is_admin - czy user ma prawa administratora (domyślnie false)
     * remember_token - pole wykorzystywane do przypominania hasła
     * created_at - kiedy utowrzony (tworzone przez temestamps() )
     * updated_at - kiedy aktualizowany (tworzone przez timestamps() )
     * 
     * @return void
     */
    public function up() {
        Schema::create('users', function(Blueprint $table) {
                    $table->increments('id');
                    $table->string('username', 64)->nullable(false);
                    $table->string('email', 100)->unique();
                    $table->string('password', 64)->nullable(false);
                    $table->boolean('is_admin')->default(false);
                    $table->string('remember_token', 100)->nullable(true);
                    $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     * Usuwa tabelę 'users'
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
