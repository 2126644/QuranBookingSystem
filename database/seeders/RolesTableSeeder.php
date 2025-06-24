<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['role_id' => 1, 'role_name' => 'Admin', 'permissions' => 'full access'], // full permissions
            ['role_id' => 2, 'role_name' => 'User', 'permissions' => 'create, view, update booking'], // example permissions
        ]);
    }

}
