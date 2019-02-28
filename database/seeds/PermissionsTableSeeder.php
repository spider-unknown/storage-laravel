<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'Create Order', 'guard_name' => 'web',
                'created_at' => now(),'updated_at' =>now()),
            array('name' => 'Edit Order', 'guard_name' => 'web',
                'created_at' => now(),'updated_at' =>now()),
            array('name' => 'Delete Order', 'guard_name' => 'web',
                'created_at' => now(),'updated_at' =>now()),
            array('name' => 'Orders', 'guard_name' => 'web',
                'created_at' => now(),'updated_at' =>now()),
        );

        DB::table('permissions')->insert($data);
    }
}
