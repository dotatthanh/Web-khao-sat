<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChooseAnswer;
use App\Models\Classes;
use App\Models\Answer;
use DB;

class StatisticController extends Controller
{
    public function statisticYear()
    {
    	$classes = Classes::paginate(10);
    	$data = [
    		'classes' => $classes,
    	];

    	return view('statistic.statistic-year', $data);
    }

    public function statisticClass(Request $request)
    {
        $answers = Answer::all();

    	$classes = ChooseAnswer::select(
    		'cau_hoi_id',
    		'lop_id',
    		'phuong_an_tra_loi_id',
    		DB::raw("count(*) as count_answer"),
    	)
    	->groupBy('lop_id', 'phuong_an_tra_loi_id')
    	->paginate(10);

        if (isset($request->search)) {
            $classes = ChooseAnswer::select(
                'cau_hoi_id',
                'lop_id',
                'phuong_an_tra_loi_id',
                DB::raw("count(*) as count_answer"),
            )
            ->where('phuong_an_tra_loi_id', $request->search)
            ->groupBy('lop_id', 'phuong_an_tra_loi_id')
            ->paginate(10);

            $classes->appends(['search' => $request->search]);
        }

    	$data = [
    		'classes' => $classes,
            'answers' => $answers,
    	];

    	return view('statistic.statistic-class', $data);
    }

    public function statisticSpecialized(Request $request)
    {
        $answers = Answer::all();

    	$specializeds = ChooseAnswer::select(
    		'cau_hoi_id',
    		'nganh_id',
    		'phuong_an_tra_loi_id',
    		DB::raw("count(*) as count_answer"),
    	)
    	->groupBy('nganh_id', 'phuong_an_tra_loi_id')
    	->paginate(10);

        if (isset($request->search)) {
            $specializeds = ChooseAnswer::select(
                'cau_hoi_id',
                'nganh_id',
                'phuong_an_tra_loi_id',
                DB::raw("count(*) as count_answer"),
            )
            ->where('phuong_an_tra_loi_id', $request->search)
            ->groupBy('nganh_id', 'phuong_an_tra_loi_id')
            ->paginate(10);

            $specializeds->appends(['search' => $request->search]);
        }

    	$data = [
    		'specializeds' => $specializeds,
            'answers' => $answers,
    	];

    	return view('statistic.statistic-specialized', $data);
    }
}
