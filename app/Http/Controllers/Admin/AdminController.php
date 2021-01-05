<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     *
     * @return void
     */
    public function index ()
    {
        return view('admin.index');
    }
}
