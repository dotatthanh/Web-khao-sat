<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'cau_hoi';
    public $timestamps = false;

    protected $fillable = [
        'phieu_khao_sat_id',
        'ten',
        'cach_chon_dap_an',
        'noi_dung',
    ];

    public function answers()
    {
    	return $this->hasMany(Answer::class, 'cau_hoi_id');
    }
}
