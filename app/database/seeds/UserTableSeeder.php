<?php

class UserTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->delete();
        
        User::create(array(
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'is_admin' => true
            
            ));
        
        User::create(array(
            'username' => 'test',
            'email' => 'test@example.com',
            'password' => Hash::make('test'),
            
            ));
    }

}

?>
