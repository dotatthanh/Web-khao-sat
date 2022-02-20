<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class DashboardController extends Controller
{
    public function index()
    {
        $total_survey_of_day = Result::where('ngay_khao_sat', date('Y-m-d'))->count();
        $total_survey_of_month = Result::whereMonth('ngay_khao_sat', date('m'))->count();

    	$data = [
    		'total_survey_of_day' => $total_survey_of_day,
            'total_survey_of_month' => $total_survey_of_month,
    	];

    	return view('dashboard', $data);
    }
}
