<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminUserRequest;
use App\Models\Database\AdminUser;
use App\Models\Database\User;
use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.admin-user.change-password');
        //return redirect()->route('admin.admin-user.index');
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6'
        ]);


        $user = auth()->guard('admin')->user();

        $curPassword = request('current_password');
        $newPassword = request('password');
        $confirmedPassword = request('password_confirmation');

        if (Hash::check($curPassword, $user->password) && $newPassword === $confirmedPassword) {
            $obj_user = AdminUser::where('id', $user->id)->first();
            $obj_user->password = bcrypt($newPassword);
            $obj_user->save();

            $request->session()->flash('success_message');

            return redirect()->back();
        }
        else
        {
            $request->session()->flash('fail_message');
            return redirect()->back();
        }
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
