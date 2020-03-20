<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql1')->table('permissions')->insert([
            [
                'name' => 'add_article',
                'guard_name' =>'api',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'edit_article',
                'guard_name' =>'api',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'delete_article',
                'guard_name' =>'api',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'view_article',
                'guard_name' =>'api',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
