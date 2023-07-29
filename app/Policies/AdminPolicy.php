<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class AdminPolicy
{
    /**
     * Create a new policy instance.
     */
    public function delete(Admin $admin)
    {
        // dd($admin);
        // return $admin->is_manager==true;

        return $this->manager($admin);
    }

    private function manager($admin)
    {
        return $admin->is_manager==true;
    }
}
