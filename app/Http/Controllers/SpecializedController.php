<?php

namespace App\Http\Controllers;

use App\Models\Specialized;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSpecializedRequest;
use DB;

class SpecializedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $specialized = Specialized::paginate(10);

        if ($request->search) {
            $specialized = Specialized::where('ten_nganh', 'like', '%'.$request->search.'%')->paginate(10);
            $specialized->appends(['search' => $request->search]);
        }

        $data = [
            'specialized' => $specialized
        ];

        return view('specialized.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specialized.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecializedRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $specialized = Specialized::create([
                'ma_nganh' => $request->code,
                'ten_nganh' => $request->ten_nganh,
            ]);

            DB::commit();
            return redirect()->route('specialized.index')->with('alert-success','Thêm chuyên ngành thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm chuyên ngành thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specialized  $specialized
     * @return \Illuminate\Http\Response
     */
    public function show(Specialized $specialized)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialized  $specialized
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialized $specialized)
    {
        $data = [
            'data_edit' => $specialized,
        ];

        return view('specialized.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialized  $specialized
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSpecializedRequest $request, Specialized $specialized)
    {
        try {
            DB::beginTransaction();

            $specialized->update([
                'ten_nganh' => $request->ten_nganh,
                'ma_nganh' => $request->code,
            ]);
            
            DB::commit();
            return redirect()->route('specialized.index')->with('alert-success','Sửa chuyên ngành thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa chuyên ngành thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialized  $specialized
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialized $specialized)
    {
        try {
            DB::beginTransaction();
            
            $specialized->destroy($specialized->id);
            
            DB::commit();
            return redirect()->route('specialized.index')->with('alert-success','Xóa chuyên ngành thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa chuyên ngành thất bại!');
        }
    }
}
