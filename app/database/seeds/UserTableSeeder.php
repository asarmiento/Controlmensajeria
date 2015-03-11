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
    }

}
