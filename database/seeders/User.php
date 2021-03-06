<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Seeder
{
    public function run()
    {
        for($i = 0; $i < 10; $i++)
        DB::table('users')->insert([
            'username' => '1',
            'email' => Str::random(10) . '@gmail.com',
            'password' => Hash::make('1'),
        ]);
    }
}
