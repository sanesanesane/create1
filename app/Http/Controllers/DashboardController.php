<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



class DashboardController extends Controller
{
public function index()
{
    Log::debug('DashboardController@index was called');
return view ('Dashboard.title');
}

public function menu()
{
    Log::debug('DashboardController@index was called');
    return view ('Dashboard.menu'); 
}

}


