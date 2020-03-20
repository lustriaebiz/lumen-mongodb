<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql1')->table('users')->insert([
            'id' => 1,
            'username' =>'user_api',
            'password' => Hash::make('secret!@#'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
