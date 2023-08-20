<?php

namespace App\Http\Controllers\Dispatcher;

use App\Http\Controllers\Controller;
use App\Http\Requests\DispatcherRegisterRequest;
use App\Models\Address;
use App\Models\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DispatcherAuthController extends Controller
{
    public function register(DispatcherRegisterRequest $request)
    {
        $dispatcher_detail = $request->only($this->data());
        $dispatcher_detail['password'] = Hash::make($dispatcher_detail['password']);
        $dispatcher = Dispatcher::create($request->only($this->data()));
        $address = $request->except(['first_name','last_name','email','password']);
        $address['addresable_type'] = dispatcher::class;
        $address['addresable_id'] = $dispatcher->id;
        Address::create($address);
        Auth::guard('dispatcher')->login($dispatcher);
        return redirect()->route('dispatcher.index');
      
    }
    
    public function login(Request $request)
    {
        if(Auth::guard('dispatcher')->attempt($request->only('email','password'))){
            $request->session()->regenerate();
            return redirect()->route('dispatcher.index');
        }
        return back()->withErrors(['email'=>'dispatcher credentials not found'])
                     ->onlyInput('email');
    }

    public function logout(Request $request)
    {
       
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('dispatcher.login')
                         ->with('msg', 'You are Logged out');
    }

    private function data()
    {
        return ['first_name','last_name','email',
        'phone_number','password'];
    }

}
