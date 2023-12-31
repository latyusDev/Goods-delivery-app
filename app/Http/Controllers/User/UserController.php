<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{   
    public function create()
    {
        return view('user.create');
    }

    public function index()
    {
        $orders = Order::with('notifications.dispatcher')
                       ->filter(Auth::id())->latest()            
                                    ->Paginate(10);
        return view('user.index',['orders'=>$orders]);
    }

    public function login()
    {   
        return view('user.login');
    }
}