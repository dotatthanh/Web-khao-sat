<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $table = 'ket_qua';
    public $timestamps = false;

    protected $fillable = [
        'phieu_khao_sat_id',
        'cuu_sinh_vien_id',
        'ket_qua',
        'ngay_khao_sat',
        'lop_id',
    ];

    public function student()
    {
    	return $this->belongsTo(Student::class, 'cuu_sinh_vien_id');
    }
}
