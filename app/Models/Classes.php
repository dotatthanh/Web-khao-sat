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

    public function getStatisticDateAttribute()
    {
        $result = $this->students()->whereHas('result', function (Builder $query) {
            $query->where('ngay_khao_sat', date('Y-m-d'));
        })->count();

        return $result;
    }

    // public function getStatisticClassAttribute()
    // {
    //     $result = $this->students()
    //         // ->whereHas('chooseAnswer', function (Builder $query) {
    //         //     // dd($query->count());
    //         //     // $query->where('ngay_khao_sat', date('Y-m-d'));
    //         // })
    //         ->get();

    //     // dd($result);

    //     return $result;
    // }
}
