<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TaiKhoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            [
                'ten' => 'admin',
                'email' => 'admin@gmail.com',
                'mat_khau' => bcrypt('123123123'),
                'admin' => 1,
            ],
        ];

       

        
        DB::table('tai_khoan')->insert($admin);
    }
}
