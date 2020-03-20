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
                'id' => 1,
                'name' => 'admin',
                'guard_name' =>'api',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'name' => 'editor',
                'guard_name' =>'api',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'name' => 'author',
                'guard_name' =>'api',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
