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
        $users = User::whereStatus(false)
                     ->get();
        $banned_users = User::whereStatus(true)
                            ->get();
        $deleted_users = User::onlyTrashed()->get();
        return view('admin.users.user_index',[
        'users'=>$users, 
        'bannedUsers'=>$banned_users,
        'deletedUsers'=>$deleted_users,
        ]);

    }


    public function showUser(User $user)
    {
        return view('admin.users.user_show',['user'=>$user]);
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back();
    }

    public function restoreUser($id)
    {
        User::withTrashed()
            ->filter($id)
            ->restore();
        return back();
    }

    public function destroyPermanently($id)
    {
        User::withTrashed()
            ->filter($id)
            ->forceDelete();
        return back();
    }

    
    public function ban($id)
    {
        $user = User::filter($id);
        $user->update(['status'=>true]);
        return back();
    }

    public function release($id)
    {
        $user = User::filter($id);
        $user->update(['status'=>false]);
        return back();
    }

    // dispatcher activities
    
    public function dispatcherIndex()
    { 
        $dispatchers = dispatcher::whereStatus(false)->get();
        $banned_dispatchers = dispatcher::whereStatus(true)->get();
        $deleted_dispatchers = dispatcher::onlyTrashed()->get();
        return view('admin.dispatchers.dispatcher_index',[
        'dispatchers'=>$dispatchers, 
        'banneddispatchers'=>$banned_dispatchers,
        'deleteddispatchers'=>$deleted_dispatchers,
    ]);

    }

    public function showdispatcher(dispatcher $dispatcher)
    {
        return view('admin.dispatchers.dispatcher_show',[
            'dispatcher'=>$dispatcher
        ]);
    }

    public function deleteDispatcher(dispatcher $dispatcher)
    {
        $dispatcher->delete();
        return back()->with('msg', $dispatcher->name.' is deleted');
    }

    public function restoreDispatcher($id)
    {
        dispatcher::withTrashed()
                  ->filter($id)
                  ->restore();
        return back();
    }

    public function destroyDispatcher($id)
    {
        dispatcher::withTrashed()
                  ->filter($id)
                  ->forceDelete();
        return back();
    }

    
    public function banDispatcher($id)
    {
        $p = Dispatcher::filter($id);
        $p->update(['status'=>true]);
        return back();
    }

    public function releaseDispatcher($id)
    {
        $dispatcher = Dispatcher::filter($id);
        $dispatcher->update(['status'=>false]);
        return back();
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

    public function deleteAdmin(Admin $admin)
    {
        $admin->delete();
        return back();
    }

    
    public function banAdmin($id)
    {
        $admin = Admin::filter($id);
        $admin->update(['status'=>true]);
        return back();
    }

    public function releaseAdmin($id)
    {
        $admin = Admin::filter($id);
        $admin->update(['status'=>false]);
        return back();
    }
}
