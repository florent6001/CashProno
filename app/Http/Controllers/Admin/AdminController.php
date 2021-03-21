<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     *
     * @return void
     */
    public function index ()
    {
        $user = new User();
        
        return view('admin.index', [
            'members_count' => $user->get_members_count(),
            'vip_count' => $user->get_vip_count()
        ]);
    }
}
