<?php

class AuthController extends BaseController {

    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only'=>array('getUserProfile')));
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
        $validator = Validator::make($data, User::$rules, User::$messages);

        // sprwadzamy czy dane są poprawne
        if ($validator->passes()) {
            $user = new User;
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            //$user->is_admin = False;
            $user->save();
            Session::put('_token', md5(microtime()));
            return Redirect::to('auth/login')
                    ->with('message', 'Rejestracja zakończona. Możesz się teraz zalogować.')
                    ->with('mtype', 'success');
        } else {
            return Redirect::to('auth/register')
                    ->withErrors($validator)->withInput();
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
            
            // zapamiętuje w sesji nazwę zalogowanego użytkownika
            Session::put('username', Auth::user()->username);
            Session::put('admin', Auth::user()->is_admin);
            
            // przekierowanie do widoku z panelem użytkownika
            return Redirect::to('/');
        } else {
            // nie udało się zalogować, ponowne wyświetlenie formularza logowania z informacją o błędzie
            return Redirect::to('auth/login')
                    ->withErrors(array('error' => 'Podany login lub hasło są nieprawidłowe!'));
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
    
    /*
     * Wyświetlenie widoku panelu użytkownika z danymi o użytkowniku
     */
    public function getUserProfile() {
        $user = User::find(Auth::user()->id);
        return View::make('auth.user_profile')
                ->with(array('user' => $user,     
            ));
    }
    
    /*
     * Funkcja odpowiada za walidacje formularza zmian w profilu użytkownika 
     * i ich zapisanie, jesli walidacja zakończyła się sukceem.
     * 
     */
    public function postUserProfile() {
        // Pobierane są dane z formularza
        //$email = Input::get('email');
        $username = Input::get('username');
        $password = Input::get('password');
        //$password = Hash::make(Input::get('password'));
        $new_password = Input::get('new_password');
        $npc = Input::get('new_password_confirmation');
        
        // wyszukanie użytkownika w bazie
        $user = User::find(Auth::user()->id);
        
        // przygotowanie danych do walidacji
        $data = array('username' => $username);
        
        // sprwdzenie czy uzytkownik zmienia hasło
        if (strlen($new_password) > 0) {
            if (strlen($npc) === 0 or $npc !== $new_password) {
                $errors = array('new_password_confirmation' => "Wartości w polach 'Potwierdź nowe hasło' i 'Nowe hasło' nie są identyczne!");
                return Redirect::to('auth/user-profile')
                                ->withErrors($errors);
            }
            $data['password'] = $new_password;
            $data['password_confirmation'] = $npc;
        } else {      
            $data['password'] = $password;
            $data['password_confirmation'] = $password;
        }
        if (!Hash::check($password, $user->password)) {
            $errors = array('password' => "Niepoprawne hasło!");
            return Redirect::to('auth/user-profile')
                                ->withErrors($errors);
        }
        $data['is_admin'] = $user->is_admin;
        $validator = Validator::make($data, array(
            'email' => 'sometimes|required|email',
            'username' => 'required|alpha_dash|min:2|max:64',
            'password' => 'required|alpha_dash|min:4|max:64|confirmed',
            'password_confirmation' => 'required|alpha_dash|min:4|max:64'
        ), User::$messages);
        //$validator = Validator::make($data, User::$rules, User::$messages);

        // sprwadzamy czy dane są poprawne
        if ($validator->passes()) {
            //
            $user->username = $username;
            //$user->username = Input::get('username');
            //$user->email = Input::get('email');
            $user->password = Hash::make($data['password']);
            //$user->is_admin = False;
            $user->save();
            Session::forget('username');
            Session::put('username',$username);
            return Redirect::to('auth/user-profile')
                            ->with(array('message' => 'Zmiany w profilu zostały pomyślnie zapisane.',
                            'mtype' => 'success'));
        }
        else {
            return Redirect::to('auth/user-profile')
                    ->with(array('message' => 'Formularz zawiera błędy.',
                            'mtype' => 'danger'))
                        ->withErrors($validator);
        }
    }
    
    
    /**
     * Wylogowanie użytkownika
     * @return type
     */
    public function getLogout() {
        // wylogowanie użytkownika
        Auth::logout();
        
        // przekierowanie do widoku logowania
        return Redirect::to('auth/login')
                            ->with(array('message' => 'Zostałeś wylogowany.',
                            'mtype' => 'success'));
    }

}