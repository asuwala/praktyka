<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     * 
     * Tworzy tabele 'users' z kolumnami:
     * id - identyfikator uzytkownika (autoincrement)
     * firstname - imię (wymagany)
     * email - adres email (wymagany, unikalny)
     * password - hasło (wymagany)
     * is_admin - czy user ma prawa administratora (domyślnie false)
     * created_at - kiedy utowrzony (tworzone przez temestamps() )
     * updated_at - kiedy aktualizowany (tworzone przez timestamps() )
     * 
     * @return void
     */
    public function up() {
        Schema::create('users', function(Blueprint $table) {
                    $table->increments('id');
                    $table->string('firstname', 32);
                    $table->string('email', 100)->unique();
                    $table->string('password', 64);
                    $table->boolean('is_admin')->default(false);
                    $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     * Usuwa tabele 'users'
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
