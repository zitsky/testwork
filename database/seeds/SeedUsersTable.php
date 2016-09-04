<?php

use Illuminate\Database\Seeder;
use \App\User;

class SeedUsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(["name"=>"Test User","email"=>"test@email.ru","password"=>Hash::make("test")]);
        User::create(["name"=>"Кирилл","email"=>"kirill@email.ru","password"=>Hash::make("test")]);
        User::create(["name"=>"Андрей","email"=>"andrey@email.ru","password"=>Hash::make("test")]);
        User::create(["name"=>"Сергей","email"=>"sergey@email.ru","password"=>Hash::make("test")]);
    }
}
