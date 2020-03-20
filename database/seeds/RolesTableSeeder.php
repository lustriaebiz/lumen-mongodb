<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql1')->table('roles')->insert([
            [
                'name' => 'admin',
                'guard_name' =>'api',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'editor',
                'guard_name' =>'api',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'author',
                'guard_name' =>'api',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
