<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ChangePasswordRequest;
use DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::paginate(10);

        if ($request->search) {
            $users = User::where('ten', 'like', '%'.$request->search.'%')->paginate(10);
            $users->appends(['search' => $request->search]);
        }

        $data = [
            'users' => $users
        ];

        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $create = User::create([
                'ten' => $request->name,
                'mat_khau' => bcrypt($request->password),
                'email' => $request->email,
                'admin' => 1,
            ]);
            
            DB::commit();
            return redirect()->route('users.index')->with('alert-success','Thêm tài khoản thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm tài khoản thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data = [
            'user' => $user,
        ];

        return view('user.profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data = [
            'data_edit' => $user,
        ];

        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            
            $user->update([
                'ten' => $request->name,
                'email' => $request->email,
            ]);
            
            DB::commit();
            return redirect()->route('users.index')->with('alert-success','Sửa tài khoản thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa tài khoản thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            $user->destroy($user->id);
            
            DB::commit();
            return redirect()->route('users.index')->with('alert-success','Xóa tài khoản thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa tài khoản thất bại!');
        }
    }

    public function viewChangePassword(User $user) 
    {
        $data = [
            'user' => $user,
        ];

        return view('user.change-password', $data);
    }

    public function changePassword(ChangePasswordRequest $request, User $user) 
    {
        try {
            DB::beginTransaction();
            
            if (Hash::check($request->password_old, $user->password)) {
                $user->update([
                    'mat_khau' => Hash::make($request->password),
                ]);
            }
            
            DB::commit();
            return redirect()->back()->with('alert-success','Đổi mật khẩu thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Đổi mật khẩu thất bại!');
        }
    }
}
