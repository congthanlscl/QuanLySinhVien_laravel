<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sinhvien;

class SinhvienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Sinhvien::Create([
            'id'       => '1700604',
            'fullname' => 'Dương Công Thần',
            'birthday' => '1999-08-28',
            'address'  => 'Cao Lâu Cao Lộc Lạng Sơn',
            'class_id' => '1'
        ]);

        Sinhvien::Create([
            'id'       => '1700605',
            'fullname' => 'Vi A Sáng',
            'birthday' => '1999-05-06',
            'address'  => 'Quảng Ninh',
            'class_id' => '1'
        ]);
    }
}
