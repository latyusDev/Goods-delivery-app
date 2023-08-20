<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $userDetails = $request->only(['first_name','last_name','email',
                                            'phone_number', 'password']);
        $userDetails['password'] = Hash::make($userDetails['password']);
        $user = User::create($userDetails);
        $address = $request->except(['first_name','last_name','email',
                                    'phone_number', 'password']);
        $address['addresable_type'] = User::class;
        $address['addresable_id'] = $user->id;
        Address::create($address);
        Auth::login($user);
        return redirect()->route('user.index');
    }
   
    public function login(Request  $request)
    {
       if(Auth::guard('web')->attempt($request->only(['email','password'])))
       {
         $request->session()->regenerate();
         return redirect()->route('user.index');
        }
        return back()->withErrors(['email'=>'User credentials not found'])
                     ->onlyInput('email');
    }
    
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.login')
                         ->with('msg', 'You are Logged out');
    }

}
