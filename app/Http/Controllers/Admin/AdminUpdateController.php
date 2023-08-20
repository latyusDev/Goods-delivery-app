<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Dispatcher;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUpdateController extends Controller
{
    
    public function banUser(User $user)
    {
        $user->updateUserStatus(
            $user->id,
            true
        );
        return back();
    }

    public function releaseUser(User $user)
    {
        $user->updateUserStatus(
            $user->id,
            false
        );
        return back();
    }

    public function banDispatcher(Dispatcher $dispatcher)
    {
        $dispatcher->updateDispatcherAvailability(
            $dispatcher->id,
            true,
            'status'
        );
        return back();
    }

    public function releaseDispatcher(Dispatcher $dispatcher)
    {
        $dispatcher->updateDispatcherAvailability(
            $dispatcher->id,
            false,
            'status'
        );
        return back();
    }

    public function banAdmin(Admin $admin)
    {
        $admin->updateAdminStatus(
            $admin->id,
            true
        );
        return back();
    }

    public function releaseAdmin(Admin $admin)
    {   
        $admin->updateAdminStatus(
            $admin->id,
            false
        );
        return back();
    }

}
