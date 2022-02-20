<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Specialized;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClassRequest;
use DB;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classes = Classes::paginate(10);

        if ($request->search) {
            $classes = Classes::where('ten_lop', 'like', '%'.$request->search.'%')->paginate(10);
            $classes->appends(['search' => $request->search]);
        }

        $data = [
            'classes' => $classes
        ];

        return view('class.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialized = Specialized::all();
        
        $data = [
            'specialized' => $specialized,
        ];

        return view('class.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $class = Classes::create([
                'nganh_id' => $request->specialized_id,
                'ma_lop' => $request->code,
                'ten_lop' => $request->name,
            ]);

            DB::commit();
            return redirect()->route('classes.index')->with('alert-success','Thêm lớp học thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm lớp học thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $classes)
    {
        $specialized = Specialized::all();

        $data = [
            'data_edit' => $classes,
            'specialized' => $specialized,
        ];

        return view('class.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClassRequest $request, Classes $classes)
    {
        try {
            DB::beginTransaction();

            $classes->update([
                'nganh_id' => $request->specialized_id,
                'ten_lop' => $request->name,
                'ma_lop' => $request->code,
            ]);

            DB::commit();
            return redirect()->route('classes.index')->with('alert-success','Sửa lớp học thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa lớp học thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $classes)
    {
        try {
            DB::beginTransaction();
            $classes->destroy($classes->id);
            
            DB::commit();
            return redirect()->route('classes.index')->with('alert-success','Xóa lớp học thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa lớp học thất bại!');
        }
    }
}
