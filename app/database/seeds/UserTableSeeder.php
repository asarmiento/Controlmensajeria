<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->delete();
        User::create(array(
            'name' => 'Gustavo',
            'last' => 'Cruz',
            'type_users_id' => 1,
            'email' => 'tavitocruz@gmail.com',
            'password' => Hash::make('admin')
        ));
        User::create(array(
            'name' => 'Anwar',
            'last' => 'Sarmiento',
            'type_users_id' => 1,
            'email' => 'anwarsarmiento@gmail.com',
            'password' => Hash::make('F4cc0unt')
        ));
        User::create(array(
            'name' => 'Carlos',
            'last' => 'Ramos',
            'type_users_id' => 1,
            'empresas_id' => 1,
            'email' => 'carl0s_ram0s@yahoo.com',
            'password' => Hash::make('carl0s')
        ));
        User::create(array(
            'name' => 'David',
            'last' => 'Osorio',
            'type_users_id' => 3,
            'empresas_id'=>1,
            'email' => 'david.osorio@claro.com.hn',
            'password' => Hash::make('dav1d')
        ));
        User::create(array(
            'name' => 'Wendy',
            'last' => 'Sauceda',
            'type_users_id' => 3,
            'empresas_id'=>1,
            'email' => 'wendy.sauceda@claro.com.hn',
            'password' => Hash::make('w3ndy')
        ));
    }

}
