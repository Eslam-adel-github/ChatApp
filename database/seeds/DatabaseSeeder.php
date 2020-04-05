<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create(["name"=>"admin","email"=>"admin@admin.com","password"=>Hash::make("123456789"),"type"=>"admin"]);
    }
}
