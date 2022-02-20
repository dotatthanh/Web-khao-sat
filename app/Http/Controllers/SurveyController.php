<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Student;
use App\Models\ChooseAnswer;
use App\Models\Result;
use App\Models\Classes;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Requests\SurveyStoreRequest;
use DB;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        $classes = Classes::all();

        $data = [
            'questions' => $questions,
            'classes' => $classes,
        ];

        return view('survey.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SurveyStoreRequest $request)
    {
        // dd($request->answers);
        $question_1 = Question::first();
        $answer_id = $request->answers[0][$question_1->id];
        $answer_1 = Answer::findOrFail($answer_id);

        try {
            DB::beginTransaction();

            $student = Student::create([
                'ma_sv' => $request->code_student,
                'lop_id' => $request->code_class,
                'ten_sv' => $request->name,
                'gioi_tinh' => $request->gender,
                'so_dien_thoai' => $request->phone,
                'email' => $request->email,
            ]);

            $result = Result::create([
                'phieu_khao_sat_id' => 1,
                'cuu_sinh_vien_id' => $student->id,
                'ngay_khao_sat' => date('Y-m-d'),
                'ket_qua' => $answer_1->noi_dung,
            ]);

            foreach ($request->answers as $question) {
                if (is_array($question[key($question)])) {
                    foreach($question[key($question)] as $answer) {
                        $choose_answer = ChooseAnswer::create([
                            'ket_qua_id' => $result->id,
                            'cau_hoi_id' => key($question),
                            'phuong_an_tra_loi_id' => $answer,
                        ]);
                    }
                }
                else {
                    $choose_answer = ChooseAnswer::create([
                        'ket_qua_id' => $result->id,
                        'cau_hoi_id' => key($question),
                        'phuong_an_tra_loi_id' => $question[key($question)],
                    ]);
                }
            }
            

            DB::commit();
            return redirect()->route('surveys.index')->with('alert-success','Khảo sát thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Khảo sát thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
