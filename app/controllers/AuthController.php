<?php

class AuthController extends BaseController {

    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only'=>array('getDashboard')));
    }

    /**
     * Wyświetlenie formularza rejestracji
     * @return type
     */
    public function getRegister() {
        // przejście do widoku z formularzem rejestracji 
        return View::make('auth.register');
    }

    /**
     * Funkcja uruchamiana po wypełnieniu 
     * forumlarza rejestracji i kliknięciu przycisku Zarejestruj.
     * 
     */
    public function postRegister() {
        // pobranie danych z formularza rejestracji
        $data = Input::all();

        // utworzenie obiektu walidacji, 
        // parametry to dane do sprawdzenia i tablica z regułami walidacji z modelu User
        $validator = Validator::make($data, User::$rules);

        // sprwadzamy czy dane są poprawne
        if ($validator->passes()) {
            $user = new User;
            $user->firstname = Input::get('firstname');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            //$user->is_admin = False;
            $user->save();
            Session::put('_token', md5(microtime()));
            return Redirect::to('auth/login')->with('message', 'Dziękujemy za rejestrację!');
        } else {
            return Redirect::to('auth/register')->with('message', 'Wystąpiły następujące błędy!')->withErrors($validator)->withInput();
        }
    }

    /**
     * Wyświetlenie formularza logowania
     * @return type
     */
    public function getLogin() {
        // przejście do widoku z formularzem logowania
        return View::make('auth.login');
    }

    /**
     * Funkcja uruchamiana po wypełnieniu formularza logowania
     * i wcisnięciu przycisku Zaloguj
     * @return type
     */
    public function postLogin() {
        // pobranie danych logowania z formularza
        $email = Input::get('email');
        $password = Input::get('password');
        $remember_me = Input::get('remember_me');
        
        // logowanie uzytkownika
        if(Auth::attempt(array('email' => $email, 'password' => $password), $remember_me)) {
            Session::put('_token', md5(microtime()));
            
            // zapamiętuje w sesji imię zalogowanego użytkownika
            Session::put('username', Auth::user()->firstname);
            
            // przekierowanie do widoku z panelem użytkownika
            return Redirect::to('auth/dashboard');
        } else {
            // nie udało się zalogować, ponowne wyświetlenie formularza logowania z informacją o błędzie
            return Redirect::to('auth/login')->with('message', 'Podany login lub/i hasło są nieprawidłowe' );
        }
        
    }
    
    /**
     * Wyświetlenie panelu zalogowanego użytkownika
     * @return type
     */
    public function getDashboard() {
        
        // przsjście do widoku z panelem użytkownika
        return View::make('auth.dashboard');
    }
    
    /**
     * Wylogowanie użytkownika
     * @return type
     */
    public function getLogout() {
        // wylogowanie użytkownika
        Auth::logout();
        
        // przekierowanie do widoku logowania
        return Redirect::to('auth/login')->with('message', 'Zostałeś wylogowany!');
    }

}