<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'phuong_an_tra_loi';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'cau_hoi_id',
        'ten',
        'noi_dung',
    ];

    public function question()
	{
	    return $this->belongsTo(Question::class, 'phieu_khao_sat_id');
	}
}
