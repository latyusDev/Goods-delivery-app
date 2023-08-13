<?php

namespace App\Policies;

use App\Models\Admin;

class AdminPolicy
{
    /**
     * Create a new policy instance.
     */
    public function delete(Admin $admin)
    {
        return $admin->is_manager==true;
    }

    
}
