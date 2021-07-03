<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Diem;

class DiemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Diem::create([
            "score"      => 10,
            "student_id" => "1700604"
        ]);

        Diem::create([
            "score"      => 5,
            "student_id" => "1700605"
        ]);
    }
}
