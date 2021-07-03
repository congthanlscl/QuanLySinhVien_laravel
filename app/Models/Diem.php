<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diem extends Model
{
    use HasFactory;

    protected $fillable = [
        "score",
        "student_id"
    ];

    public function sinhvien(){

        return $this->belongsTo(Sinhvien::class, "student_id");
    }
}
