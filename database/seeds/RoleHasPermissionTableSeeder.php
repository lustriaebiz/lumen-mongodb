<?php

use Illuminate\Database\Seeder;

class RoleHasPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql1')->table('role_has_permissions')->insert([
            [
                'permission_id' => 1,
                'role_id' => 3
            ],
            [
                'permission_id' => 2,
                'role_id' => 3
            ],
            [
                'permission_id' => 3,
                'role_id' => 3
            ],
            [
                'permission_id' => 4,
                'role_id' => 3
            ]
        ]);
    }
}