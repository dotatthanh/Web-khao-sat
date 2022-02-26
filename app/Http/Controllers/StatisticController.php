<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChooseAnswer;
use App\Models\Classes;
use App\Models\Answer;
use App\Models\Result;
use DB;

class StatisticController extends Controller
{
    public function statisticYear()
    {
    	// $classes = Classes::paginate(10);
        $classes = Classes::select(
            'ma_lop',
            DB::raw("lop.id as id_lop"),
            DB::raw("count(*) as total"),
            DB::raw("
                (SELECT COUNT(*) AS COUNT
                FROM ket_qua
                INNER JOIN cuu_sinh_vien ON ket_qua.cuu_sinh_vien_id = cuu_sinh_vien.id
                INNER JOIN lop ON cuu_sinh_vien.lop_id = lop.id
                WHERE ket_qua = 'Đang có việc làm' AND lop.id = id_lop) as dang_lam_viec"),
            DB::raw("
                (SELECT COUNT(*) AS COUNT
                FROM ket_qua
                INNER JOIN cuu_sinh_vien ON ket_qua.cuu_sinh_vien_id = cuu_sinh_vien.id
                INNER JOIN lop ON cuu_sinh_vien.lop_id = lop.id
                WHERE ket_qua = 'Chưa có việc làm' AND lop.id = id_lop) as chua_co_viec"),
        )
        ->join('cuu_sinh_vien', 'lop.id', '=', 'cuu_sinh_vien.lop_id')
        ->join('ket_qua', 'cuu_sinh_vien.id', '=', 'ket_qua.cuu_sinh_vien_id')
        ->whereYear('ngay_khao_sat', date('Y'))
        ->groupBy('ma_lop')
        ->paginate(10);


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

    public function statisticChart()
    {
        $result = Result::select(
            'ket_qua as x',
            DB::raw("count(*) as value"),
        )
        ->groupBy('ket_qua')
        ->get();

        $data = [
            'result' => $result,
        ];

        return view('statistic.statistic-chart', $data);
    }
}
