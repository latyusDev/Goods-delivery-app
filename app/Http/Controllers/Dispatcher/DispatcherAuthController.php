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
        $dispatcher_detail = $request->only(['first_name','last_name','email',
        'phone_number','password']);
        $dispatcher_detail['password'] = Hash::make($dispatcher_detail['password']);
        $dispatcher = Dispatcher::create($request->only(['first_name','last_name','email',
        'phone_number','password']));
        $address = $request->except(['first_name','last_name','email','password']);
        $address['addresable_type'] = dispatcher::class;
        $address['addresable_id'] = $dispatcher->id;
        Address::create($address);
        
        Auth::guard('dispatcher')->login($dispatcher);
        return redirect('/dispatcher/index');
      
    }
    
    public function login(Request $request)
    {
        $dispatcher = Dispatcher::whereEmail($request->email)->first();
        if($dispatcher == null){
            return back()->withErrors(['email'=>'dispatcher credentials not found'])
            ->onlyInput('email');
        }else if($dispatcher->status ){
            return back()->withErrors([
               'email'=>'Your account was banned on '
               .$dispatcher->updated_at->toDayDateTimeString().' contact the admin for more info' ])
                     ->onlyInput('email');
        }
            else if(Auth::guard('dispatcher')->attempt($request->only('email','password'))){
            $request->session()->regenerate();
            return redirect('/dispatcher/index');
        }
        return back()->withErrors(['email'=>'dispatcher credentials not found'])
                     ->onlyInput('email');
    }

    public function logout(Request $request)
    {
       
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/dispatcher/login')->with('msg', 'You are Logged out');
    }

}
