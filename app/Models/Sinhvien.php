<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\LopHoc;

class Sinhvien extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'id',
        'avatar',
        'fullname',
        'birthday',
        'address',
        'class_id',
    ];

    public function lop_hocs(){

        return $this->belongsTo(LopHoc::class, 'class_id');
    }

    public function diem(){

        return $this->hasMany(Diem::class);
    }
}
