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
                'id' => 1,
                'name' => 'add_article',
                'guard_name' =>'api',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'name' => 'edit_article',
                'guard_name' =>'api',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'name' => 'delete_article',
                'guard_name' =>'api',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'name' => 'view_article',
                'guard_name' =>'api',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
