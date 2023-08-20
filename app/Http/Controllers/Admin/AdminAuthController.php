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
        $adminDetail = $request->safe()->only(['first_name','last_name','email',
                                             'phone_number','password' ]);
        $adminDetail['password'] = Hash::make($adminDetail['password']);
        $admin = Admin::create($adminDetail);
        $address = $request->safe()->except(['first_name','last_name','email',
                                             'phone_number','password' ]);
        $address['addresable_type'] = Admin::class;
        $address['addresable_id'] = $admin->id;
        Address::create($address);
        Auth::guard('admin')->login($admin);
        return redirect()->route('admin.index');
    }

    public function login(Request $request)
    {
       if(Auth::guard('admin')->attempt($request->only('email','password')))
       {
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }
        return back()->withErrors(['email'=>'Admin credentials not found'])
                     ->onlyInput('email');
    }


    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('msg', 'You are Logged out');
    }

  
}
