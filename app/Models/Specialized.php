<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialized extends Model
{
    use HasFactory;

    protected $table = 'nganh';
    public $timestamps = false;

    protected $fillable = [
        'ma_nganh',
        'ten_nganh',
    ];

    public function classes()
    {
    	return $this->hasMany(Classes::class, 'nganh_id');
    }
}
