<?php

namespace App\Http\Controllers\Admin;
                    
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Dispatcher;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function create()
    {
        return view('admin.create');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function login()
    {
        return view('admin.login');
    }
    
    // orders
    public function orderIndex()
    {
        $orders = Order::all();
        return view('admin.orders.order_index',['orders'=>$orders]);
    }

    public function orderShow(Order $order)
    {
       return view('admin.orders.order_show',['order'=>$order]);
    }

    // user activities
    public function userIndex()
    { 
        $users = User::all();
        return view('admin.users.user_index',[
                    'users'=>$users, 
        ]);
    }


    public function showUser(User $user)
    {
        return view('admin.users.user_show',['user'=>$user]);
    }

    // dispatcher activities
    public function dispatcherIndex()
    { 
        $dispatchers = dispatcher::all();
        return view('admin.dispatchers.dispatcher_index',[
                    'dispatchers'=>$dispatchers
         ]);
    }

    public function showdispatcher(dispatcher $dispatcher)
    {
        return view('admin.dispatchers.dispatcher_show',[
            'dispatcher'=>$dispatcher
        ]);
    }

   // admin
    public function adminIndex()
    { 
        $admins = Admin::all();
        return view('admin.admin_index',['admins'=>$admins]);
    }

    public function showAdmin(Admin $admin)
    {
        return view('admin.admin_show',['admin'=>$admin]);
    }

}
