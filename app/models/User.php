<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    /**
     * Reguły walidacji dla rejestracji nowego użytkownika
     * @var type 
     */
    public static $rules = array(
        'username' => 'required|alpha_dash|min:2|max:64',
        'email' => 'required|email|unique:users',
        'password' => 'required|alpha_dash|min:4|max:64|confirmed',
        'password_confirmation' => 'required|alpha_dash|min:4|max:64'
    );

    public static $messages = array(
        'required' => 'Pole :attribute nie może być puste.',
        'alpha_dash' => 'Pole może zawierać jedynie znaki alfanumeryczne.',
        'min' => 'Minimalna liczba znaków w polu to :min.',
        'max' => 'Maksymalna liczba znaków w polu to :max.',
        
        'email.email' => 'Niepoprawny format adresu email.',
        'email.unique:users' => 'Użytkownik o takim adresie już istnieje.',
        
        'password.confirmed' => 'Wprowadzone hasła muszą być takie same.',
    );
    /**
     * Disable automatic temestamp (created_at, updated_at) updates in model.
     * Dla użytkownikow nie zaszkodzi przechowywać tych informacji więc zakomentujemy tą linijke.
     * @var bool 
     */
    # public $timestamps = false;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail() {
        return $this->email;
    }

}