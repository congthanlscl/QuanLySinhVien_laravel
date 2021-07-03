<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LopHoc;

class LopHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        LopHoc::create([
            'class_name' => 'K41_CNTT3',
            'lecturers'  => 'Dương Công Thần',
        ]);

        LopHoc::create([
            'class_name' => 'K41_CNTT4',
            'lecturers'  => 'Hà Gia Sơn',
        ]);
    }
}
