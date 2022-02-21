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
    ];

    public function class()
    {
    	return $this->belongsTo(Classes::class, 'lop_id');
    }

    public function result()
    {
        return $this->hasOne(Result::class, 'cuu_sinh_vien_id');
    }
}
