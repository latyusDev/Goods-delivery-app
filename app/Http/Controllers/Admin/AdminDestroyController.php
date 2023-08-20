<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Dispatcher;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDestroyController extends Controller
{
    public function deleteUser(User $user)
    {
        $user->delete();
        return back();
    }

    public function deleteDispatcher(Dispatcher $dispatcher)
    {
        $dispatcher->delete();
        return back()->with('msg','A dispatcher is
                             deleted successfully');
    }
    
    public function deleteAdmin(Admin $admin)
    {
        $admin->delete();
        return back();
    }
}
