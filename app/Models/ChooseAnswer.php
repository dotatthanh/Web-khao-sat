<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChooseAnswer extends Model
{
    use HasFactory;

    protected $table = 'cau_tra_loi';
    public $timestamps = false;

    protected $fillable = [
        'ket_qua_id',
        'cau_hoi_id',
        'phuong_an_tra_loi_id',
        'lop_id',
        'nganh_id',
    ];

    public function class()
    {
    	return $this->belongsTo(Classes::class, 'lop_id');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'phuong_an_tra_loi_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'cau_hoi_id');
    }

    public function specialized()
    {
        return $this->belongsTo(Specialized::class, 'nganh_id');
    }
}
