<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        //ページ遷移
        return view('dashboard.title');
    }

    public function menu()
    {
        //ページ遷移
        return view('dashboard.menu');
    }
}


