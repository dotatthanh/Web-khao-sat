<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'cuu_sinh_vien';
    public $timestamps = false;

    protected $fillable = [
        'lop_id',
        'ma_sv',
        'ten_sv',
        'gioi_tinh',
        'so_dien_thoai',
        'email',
        // 'result_date',
    ];

    public function class()
    {
    	return $this->belongsTo(Classes::class, 'lop_id');
    }

    // public function chooseAnswer()
    // {
    //     return $this->hasOne(ChooseAnswer::class, 'cuu_sinh_vien_id');
    // }

    public function result()
    {
        return $this->hasOne(Result::class, 'cuu_sinh_vien_id');
    }

    // public function setResultDateAttribute()
    // {
    //     return $this->result()->where('ngay_khao_sat', data('Y-m-d'))->count();
    // }
}
