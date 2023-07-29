<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRegisterRequest;
use App\Models\Address;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{

    public function register(AdminRegisterRequest $request)
    {
        $admin_detail = $request->only(['first_name','last_name','email',
        'phone_number','password']);
        $admin_detail['password'] = Hash::make($admin_detail['password']);
        $admin = Admin::create($admin_detail);
        $address = $request->except(['first_name','last_name','email',
        'phone_number','password']);
        $address['addresable_type'] = Admin::class;
        $address['addresable_id'] = $admin->id;
        Address::create($address);
        
        Auth()->guard('admin')->login($admin);
        return redirect('/admin/index');
    }

    public function login(Request $request)
    {
        $admin = Admin::whereEmail($request->email)->first();
        if($admin == null){
            return back()->withErrors(['email'=>'Admin credentials not found'])
            ->onlyInput('email');
        }
       else if($admin->status){
            return back()->withErrors(['email'=>'You have been banned'])
                         ->onlyInput('email');
        }
       else if(Auth::guard('admin')->attempt($request->only('email',
         'password'))){
            $request->session()->regenerate();
            return redirect('/admin/index');
        }
        return back()->withErrors(['email'=>'Admin credentials not found'])
                     ->onlyInput('email');
    }


    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login')->with('msg', 'You are Logged out');
    }

}
