<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name'=>'driver', 'guard_name'=> 'web',
                'created_at' => now(), 'updated_at' => now()),
            array('name'=>'company', 'guard_name'=> 'web',
                'created_at' => now(), 'updated_at' => now()),
        );
        DB::table('roles')->insert($data);
    }
}
