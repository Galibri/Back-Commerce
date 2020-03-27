<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            [
                'id' => 1, 
                'name' => 'Admin', 
                'email' => 'admin@admin.test', 
                'password' => Hash::make('password'), 
                'type' => 'administrator', 
                'status' => 1,
                'image' => '',
            ],
        ];

        DB::table('admins')->insert($adminRecords);
    }
}
