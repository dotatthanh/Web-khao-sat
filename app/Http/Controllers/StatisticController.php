<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChooseAnswer;
use App\Models\Classes;
use DB;

class StatisticController extends Controller
{
    public function statisticDate()
    {
    	$classes = Classes::paginate(10);
    	$data = [
    		'classes' => $classes,
    	];

    	return view('statistic.statistic-date', $data);
    }

    public function statisticClass()
    {
    	$classes = ChooseAnswer::select(
    		'cau_hoi_id',
    		'lop_id',
    		'phuong_an_tra_loi_id',
    		DB::raw("count(*) as count_answer"),
    	)
    	->groupBy('lop_id', 'phuong_an_tra_loi_id')
    	->paginate(10);

    	$data = [
    		'classes' => $classes,
    	];

    	return view('statistic.statistic-class', $data);
    }

    public function statisticSpecialized()
    {
    	$specializeds = ChooseAnswer::select(
    		'cau_hoi_id',
    		'nganh_id',
    		'phuong_an_tra_loi_id',
    		DB::raw("count(*) as count_answer"),
    	)
    	->groupBy('nganh_id', 'phuong_an_tra_loi_id')
    	->paginate(10);

    	$data = [
    		'specializeds' => $specializeds,
    	];

    	return view('statistic.statistic-specialized', $data);
    }
}
