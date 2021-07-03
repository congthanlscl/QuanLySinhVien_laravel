<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Sinhvien;

class LopHoc extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_name',
        'lecturers'
    ];

    public function sinhviens(){

        return $this->hasMany(Sinhvien::class);
    }
}
