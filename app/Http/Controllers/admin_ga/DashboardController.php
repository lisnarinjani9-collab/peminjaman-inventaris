<?php

namespace App\Http\Controllers\admin_ga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin_ga.pages.dashboard');
    }
}
