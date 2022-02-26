<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'lop';
    public $timestamps = false;

    protected $fillable = [
        'nganh_id',
        'ma_lop',
        'ten_lop',
    ];

    public function specialized()
    {
    	return $this->belongsTo(Specialized::class, 'nganh_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'lop_id');
    }

    // public function getNumberSurveyYearAttribute()
    // {
    //     $result = $this->students()->whereHas('result', function (Builder $query) {
    //         $query->whereYear('ngay_khao_sat', date('Y'));
    //     })->count();

    //     return $result;
    // }

    // public function getNumberPeopleWithoutJobsAttribute()
    // {
    //     $result = $this->students()->whereHas('result', function (Builder $query) {
    //         $query->whereYear('ngay_khao_sat', date('Y'))->where('ket_qua', 'Chưa có việc làm');
    //     })->count();

    //     return $result;
    // }

    // public function getNumberPeopleWithJobsAttribute()
    // {
    //     $result = $this->students()->whereHas('result', function (Builder $query) {
    //         $query->whereYear('ngay_khao_sat', date('Y'))->where('ket_qua', 'Đang có việc làm');
    //     })->count();

    //     return $result;
    // }

    public function results()
    {
        return $this->hasMany(Results::class, 'lop_id');
    }
}
