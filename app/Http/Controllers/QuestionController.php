<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionRequest;
use DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $questions = Question::paginate(10);

        if ($request->search) {
            $questions = Question::where('ten', 'like', '%'.$request->search.'%')->paginate(10);
            $questions->appends(['search' => $request->search]);
        }

        $data = [
            'questions' => $questions
        ];

        return view('question.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $question = Question::create([
                'phieu_khao_sat_id' => 1,
                'ten' => $request->name_question,
                'noi_dung' => $request->content_question,
                'cach_chon_dap_an' => $request->type,
            ]);
            
            foreach ($request->answers as $value) {
                Answer::create([
                    'cau_hoi_id' => $question->id,
                    'ten' => $value['name'],
                    'noi_dung' => $value['content'],
                ]);
            }
            DB::commit();
            return redirect()->route('questions.index')->with('alert-success','Thêm câu hỏi thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm câu hỏi thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $data = [
            'data_edit' => $question,
        ];

        return view('question.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestionRequest $request, Question $question)
    {
        try {
            DB::beginTransaction();

            $question->answers()->delete();
            $question->update([
                'ten' => $request->name_question,
                'noi_dung' => $request->content_question,
                'cach_chon_dap_an' => $request->type,
            ]);

            foreach ($request->answers as $value) {
                Answer::create([
                    'id' => $value['id'],
                    'cau_hoi_id' => $question->id,
                    'ten' => $value['name'],
                    'noi_dung' => $value['content'],
                ]);
            }
            
            DB::commit();
            return redirect()->route('questions.index')->with('alert-success','Sửa câu hỏi thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa câu hỏi thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        try {
            DB::beginTransaction();
            
            $question->answers()->delete();
            $question->destroy($question->id);
            
            DB::commit();
            return redirect()->route('questions.index')->with('alert-success','Xóa câu hỏi thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa câu hỏi thất bại!');
        }
    }
}
